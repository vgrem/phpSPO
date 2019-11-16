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
     * @param $typeName string
     * @return bool
     */
    public function validateType($typeName)
    {
        $class = null;
        $parts = explode('.', $typeName);

        //validate against namespaces
        if (count($parts) < 2 || ($parts[0] !== "SP")) {
            return false;
        }

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

    /**
     * @param $typeName string
     * @param array $type
     */
    public function addType($typeName,array $type)
    {
        $this->types[$typeName] = &$type;
    }



    /**
     * @param $typeName string
     * @param $baseType string
     * @return bool
     */
    public function resolveType($typeName, $baseType)
    {
        //validate type
        if (!$this->validateType($typeName)) {
            return null;
        }

        $typeInfo = $this->getTypeInfo($typeName);
        if(is_null($typeInfo)){
            //echo "Unknown type: $typeName" . PHP_EOL;
            return false;
        }

        //ensure the existing type
        if(isset($this->types[$typeName]))
            return true;

        try {
            $class = new ReflectionClass($typeInfo['name']);
            $type = array('state' => 'attached', 'type' => $class->getName(), 'file' => $class->getFileName(), 'properties' => array());
        } catch (ReflectionException $e) {
            $type = array('state' => 'detached', 'type' => $typeInfo['name'], 'file' => $typeInfo['file'], 'properties' => array());
        }
        $type['name'] = $typeInfo['alias'];
        $type['baseType'] = $baseType;
        $this->addType($typeName,$type);
        return true;
    }


    /**
     * @param $propName
     * @param string $propType
     * @param string $baseType
     * @param bool $readOnly
     * @return bool
     */
    public function resolveProperty($propName, $propType, $baseType,$readOnly=false)
    {
        $propertyList = array();
        $parts = explode('.', $propName);
        $propertyAlias = array_pop($parts);
        $typeName = implode('.', $parts);

        //ensure type exists
        if (!$this->resolveType($typeName, $baseType)) {
            return false;
        }

        //skip properties for non existent types
        $type = &$this->types[$typeName];
        if ($type['state'] !== 'attached')
            return false;

        if ($baseType === 'ClientObject' || $baseType === 'ClientObjectCollection') {
            if ($readOnly) {
                $propertyList["get$propertyAlias"] = array('name' => $propertyAlias, 'template' => 'getObjectProperty');
            } else {
                $propertyList["get$propertyAlias"] = array('name' => $propertyAlias, 'template' => 'getValueProperty');
                $propertyList["set$propertyAlias"] = array('name' => $propertyAlias, 'template' => 'setValueProperty');
            }
        } else {
            $propertyList[$propertyAlias] = array('name' => $propertyAlias, 'template' => null);
        }

        foreach ($propertyList as $name => $property) {
            try {
                $class = new ReflectionClass($type['type']);
                if (!is_null($property['template']))
                    $class->getMethod($name);
                else
                    $class->getProperty($name);
                $property['state'] = 'attached';
            } catch (ReflectionException $e) {
                $property['state'] = 'detached';
            }
            $typeInfo = $this->getTypeInfo($propType);
            $property['type'] = $typeInfo['name'];
            $type['properties'][$name] = $property;
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
        return array(
            'alias' => array_slice($parts, -1)[0],
            'name' => $this->options['rootNamespace'] . '\\' . implode('\\', $parts),
            'file' => $this->options['outputPath'] . "\\" . implode('\\', $parts) . ".php",
            'primitive' => false
        );
    }


    /**
     * @var array
     */
    private $types = null;


}
