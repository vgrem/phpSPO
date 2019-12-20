<?php


namespace Office365\PHP\Client\Runtime\OData;
use ReflectionClass;
use ReflectionException;



class ODataModel
{

    private $options;
    /**
     * @var array
     */
    private $primitiveTypeMappings;


    public function __construct($options)
    {
        $this->options = $options;
        $this->primitiveTypeMappings = array(
            "Edm.String" => "string",
            "Edm.Boolean" => "bool",
            "Edm.Guid" => "string",
            "Edm.Int32" => "integer",
            "Edm.Binary" => "string",
            "Edm.Byte" => "string",
            "Edm.DateTime" => "string",
            "Edm.Int64" => "integer",
            "Edm.Double" => "double"
        );
        $collTypeMappings = array();
        foreach ($this->primitiveTypeMappings as $k=>$v){
            $collTypeMappings["Collection($k)"] = "array";
        }
        $this->primitiveTypeMappings = array_merge($this->primitiveTypeMappings, $collTypeMappings);
    }

    public function getTypes()
    {
        return $this->types;
    }



    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $typeSchema
     * @return bool
     */
    public function validateType($typeSchema)
    {
        $typeParts = explode('.', $typeSchema['name']);
        //validate against namespaces
        if (count($typeParts) < 2 || ($typeParts[0] !== "SP")) {
            return false;
        }

        //verify if type is not marked as ignored
        if (in_array($typeSchema['name'], $this->options['ignoredTypes'])) {
            return false;
        }
        $result = array_filter($this->options['ignoredTypes'],function ($ignoredType) use($typeSchema){
            return fnmatch($ignoredType, $typeSchema['name']);
        });
        if(count($result) !== 0)
            return false;

        return true;
    }

    /**
     * @param array $typeSchema
     */
    public function addType(array $typeSchema)
    {
        $typeName = $typeSchema['name'];
        $this->types[$typeName] = $typeSchema;
    }

    public function addProperty(array $typeSchema,$propertyName, array $propSchema)
    {
        $typeName = $typeSchema['name'];
        $this->types[$typeName]['properties'][$propertyName] = $propSchema;
    }

    public function addFunction(array $funcSchema)
    {
        $typeName = $funcSchema['name'];
        $funcName = $funcSchema['alias'];
        $this->types[$typeName]['functions'][$funcName] = $funcSchema;
    }

    /**
     * @param $typeSchema
     * @return bool
     */
    public function resolveType(&$typeSchema)
    {
        //validate type
        if (!$this->validateType($typeSchema)) {
            //echo "Unknown type: $typeName" . PHP_EOL;
            return null;
        }

        //ensure the existing type
        if(isset($this->types[$typeSchema['name']]))
            return true;

        $typeInfo = $this->getTypeInfo($typeSchema['name']);
        try {
            $class = new ReflectionClass($typeInfo['name']);
            $typeSchema['state'] = 'attached';
            $typeSchema['type'] = $class->getName();
            $typeSchema['file'] = $class->getFileName();
            $typeSchema['namespace'] = $class->getNamespaceName();
        } catch (ReflectionException $e) {
            $typeSchema['state'] = 'detached';
            $typeSchema['file'] = $typeInfo['file'];
            $typeSchema['type'] = $typeInfo['name'];
            $typeSchema['namespace'] = $typeInfo['namespace'];
        }
        $this->addType($typeSchema);
        return true;
    }


    public function resolveFunction(array $funcSchema)
    {
        if(is_null($funcSchema['name'])){
            return false;
        }

        /*if (!$this->resolveType($funcSchema)) {
            return false;
        }

        //$this->addFunction($funcSchema);*/
        return true;
    }


    /**
     * @param array $typeSchema
     * @param array $propSchema
     * @return bool
     */
    public function resolveProperty( &$typeSchema,&$propSchema)
    {
        //verify if property is not marked as ignored
        if (in_array($propSchema['name'], $this->options['ignoredProperties'])) {
            return false;
        }

        //ensure type exists for a property
        if (!$this->resolveType($typeSchema)) {
            return false;
        }

        //exclude properties if unknown type
        $typeInfo = $this->getTypeInfo($propSchema['type']);
        $propSchema['type'] = $typeInfo['name'];
        if ($typeInfo['primitive'] === false && !file_exists($typeInfo['file'])) {
          return false;
        }

        $templateMapping = array();
        $propertyName = $propSchema['name'];
        if ($typeSchema['baseType'] === 'ClientObject' || $typeSchema['baseType'] === 'ClientObjectCollection') {
            if (isset($propSchema['readOnly'])) {
                $templateMapping['getObjectProperty'] = "get$propertyName";
            } else {
                $templateMapping['getValueProperty'] = "get$propertyName";
                $templateMapping['setValueProperty'] = "set$propertyName";
            }
        }

        if(count($templateMapping) > 0){
            foreach ($templateMapping as $key=>$value) {
                try {
                    $class = new ReflectionClass($typeSchema['type']);
                    $class->getMethod($value);
                    $propSchema['state'] = 'attached';
                } catch (ReflectionException $e) {
                    $propSchema['state'] = 'detached';
                }
                $propSchema['template'] = $key;
                $this->addProperty($typeSchema,$value,$propSchema);
            }
        }
        else{
            try {
                $class = new ReflectionClass($typeSchema['type']);
                $class->getProperty($propertyName);
                $propSchema['state'] = 'attached';
            } catch (ReflectionException $e) {
                $propSchema['state'] = 'detached';
            }
            $this->addProperty($typeSchema,$propertyName,$propSchema);
        }
        return true;
    }


    /**
     * @param $typeName string
     * @return array|null
     */
    public function getTypeInfo($typeName)
    {
        if (array_key_exists($typeName, $this->primitiveTypeMappings)) {
            return array(
                'name' => $this->primitiveTypeMappings[$typeName],
                'primitive' => true
            );
        }

        if (substr($typeName, 0, strlen("Collection")) === "Collection") {
            $itemTypeName = str_replace("Collection(", "", $typeName);
            $itemTypeName = str_replace(")", "", $itemTypeName);
            $typeName = $itemTypeName . "Collection";
        }
        $parts = explode('.', $typeName);
        array_shift($parts);
        $types = array_slice($parts, 0, -1);
        return array(
            'alias' => array_slice($parts, -1)[0],
            'name' => $this->options['rootNamespace'] . '\\' . implode('\\', $parts),
            'file' => $this->options['outputPath'] . "\\" . implode('\\', $parts) . ".php",
            'namespace' => count($types) > 0 ? $this->options['rootNamespace'] .  '\\' . implode('\\', $types) : $this->options['rootNamespace'],
            'primitive' => false
        );
    }


    /**
     * @var array
     */
    private $types = null;
}
