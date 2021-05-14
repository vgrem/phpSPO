<?php


namespace Office365\Runtime\OData;
use ReflectionClass;
use ReflectionException;



class ODataModel
{

    private $typeResolvedEvent;

    /**
     * @param array $options
     */
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
        $this->functions = array();
    }

    public function onTypeResolved(callable $event)
    {
        $this->typeResolvedEvent = $event;
    }


    public function getTypes()
    {
        return $this->types;
    }

    public function getFunctions()
    {
        return $this->functions;
    }


    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $typeName
     * @return bool
     */
    public function validateType($typeName)
    {
        //verify if type is not marked as ignored
        if (in_array($typeName, $this->options['ignoredTypes'])) {
            return false;
        }
        $result = array_filter($this->options['ignoredTypes'],function ($ignoredType) use($typeName){
            return fnmatch($ignoredType, $typeName);
        });
        if(count($result) !== 0)
            return false;

        return true;
    }



    public function addProperty(array $typeSchema,array $propSchema)
    {
        $typeName = $typeSchema['name'];
        $propertyKey = $propSchema['alias'];
        $this->types[$typeName]['properties'][$propertyKey] = $propSchema;
    }

    /**
     * @param array $funcSchema
     * @return bool
     *
     */
    public function resolveFunction(array &$funcSchema)
    {
        if(is_null($funcSchema['name'])){
            return false;
        }
        if (!$this->validateType($funcSchema['returnType'])) {
            return false;
        }

        if($funcSchema['isBindable'] === false){
            $funcName = $funcSchema['alias'];
            $this->functions[$funcName] = &$funcSchema;
        }
        return true;
    }


    public function resolveParameter(&$funcSchema, array $parameterSchema)
    {
        if($funcSchema['isBindable'] === false) {
           return false;
        }

        $funcName = $funcSchema['alias'];
        $paramName = $parameterSchema['name'];
        if ($paramName === "this") {
            $typeSchema = array('name' => $parameterSchema['type']);
            if ($this->resolveType($typeSchema) === true) {
                try {
                    $class = new ReflectionClass($typeSchema['type']);
                    $class->getMethod($funcName);
                    $funcSchema['state'] = 'attached';
                } catch (ReflectionException $e) {
                    $funcSchema['state'] = 'detached';
                }
                $typeName = $typeSchema['name'];
                $this->types[$typeName]['functions'][$funcName] = &$funcSchema;
            }
        } else {
            $typeInfo = $this->getTypeInfo($parameterSchema['type']);
            $parameterSchema['type'] = $typeInfo;
            $funcSchema['parameters'][$paramName] = $parameterSchema;
        }
        return true;
    }

    /**
     * @param $typeSchema
     * @return bool
     */
    public function resolveType(&$typeSchema)
    {
        $key = $typeSchema['name'];
        //validate type
        if (!$this->validateType($key)) {
            //echo "Unknown type: $typeName" . PHP_EOL;
            return false;
        }

        //ensure the existing type
        if(isset($this->types[$key])) {
            $this->types[$key] = array_merge($typeSchema, $this->types[$key]);
            $typeSchema = $this->types[$key];
            return true;
        }

        $typeInfo = $this->getTypeInfo($key);
        $typeSchema['alias'] = $typeInfo['alias'];
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
        $this->types[$key] = $typeSchema;
        if (is_callable($this->typeResolvedEvent)) {
            call_user_func($this->typeResolvedEvent, $typeSchema);
        }
        return true;
    }


    /**
     * @param array $typeSchema
     * @param array $propSchema
     * @return bool
     */
    public function resolveProperty(&$typeSchema,&$propSchema)
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
        $propSchema['typeAlias'] = isset($typeInfo['alias']) ? $typeInfo['alias'] : $typeInfo['name'];
        if ($typeInfo['primitive'] === false && !file_exists($typeInfo['file'])) {
          return false;
        }

        $templateMapping = array();
        $propertyName = $propSchema['name'];
        if ($typeSchema['baseType'] === 'EntityType') {
            if (isset($propSchema['readOnly']) && $propSchema['readOnly'] === true) {
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
                $propSchema['alias'] = $value;
                $this->addProperty($typeSchema,$propSchema);
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
            $propSchema['alias'] = $propertyName;
            $this->addProperty($typeSchema,$propSchema);
        }

        return true;
    }


    /**
     * @param $typeName string
     * @return array|null
     */
    public function getTypeInfo($typeName)
    {
        if (array_key_exists($typeName, $this->options['typeMappings'])) {
            $typeName = $this->options['typeMappings'][$typeName];
        }

        if (array_key_exists($typeName, $this->primitiveTypeMappings)) {
            return array(
                'name' => $this->primitiveTypeMappings[$typeName],
                'primitive' => true,
            );
        }

        $collection = false;
        if (substr($typeName, 0, strlen("Collection")) === "Collection") {
            $itemTypeName = str_replace("Collection(", "", $typeName);
            $itemTypeName = str_replace(")", "", $itemTypeName);
            $typeName = $itemTypeName . "Collection";
            $collection = true;
        }
        $parts = explode('.', $typeName);
        $parts[0] = $this->options['rootNamespace'];
        $typeAlias = array_pop($parts);
        $namespace = implode(DIRECTORY_SEPARATOR,array_filter($parts));
        $filePath = implode(DIRECTORY_SEPARATOR,array_filter([str_replace($this->options['rootNamespace'],"",$namespace),$typeAlias . ".php"]));

        return array(
            'alias' => $typeAlias,
            'name' => implode(DIRECTORY_SEPARATOR,[$namespace,$typeAlias]),
            'file' => implode(DIRECTORY_SEPARATOR,[$this->options['outputPath'],$filePath]),
            'namespace' => $namespace,
            'primitive' => false,
            'collection' => $collection
        );
    }


    /**
     * @var array
     */
    private $types = null;

    /**
     * @var array
     */
    private $functions = null;

    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $primitiveTypeMappings;

}
