<?php


namespace Office365\PHP\Client\Runtime\OData;
use ReflectionClass;
use ReflectionException;



class ODataModel
{

    private $options;


    public function __construct($options)
    {
        $this->options = $options;
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
        if (count($parts) < 2 || $parts[0] !== "SP") {
            return false;
        }

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
     * @param $baseTypeName string
     * @return bool
     */
    public function resolveType($typeName, $baseTypeName)
    {
        if (!$this->validateType($typeName)) {
            //echo "Unknown type: $typeName" . PHP_EOL;
            return false;
        }
        if(isset($this->types[$typeName]))
            return true;

        $parts = explode('.', $typeName);
        array_shift($parts);
        $className = $this->options['rootNamespace'] . '\\' . implode('\\', $parts);

        try {
            $class = new ReflectionClass($className);
            $type = array('state' => 'attached', 'type' => $class->getName(), 'file' => $class->getFileName(), 'properties' => array());
        } catch (ReflectionException $e) {
            $outputFile = $this->options['outputPath'] . "\\" . implode('\\', $parts) . ".php";
            $className = $this->options['rootNamespace'] . "\\" . implode('\\', $parts);
            $type = array('state' => 'detached', 'type' => $className, 'file' => $outputFile, 'properties' => array());
        }
        $type['name'] = array_slice($parts, -1)[0];
        $type['baseType'] = str_replace("\\SharePoint","\\Runtime",$this->options['rootNamespace']) . "\\" . $baseTypeName;
        $this->addType($typeName,$type);
        return true;
    }


    /**
     * @param $propertyName string
     * @param $typeName string
     * @param null|string $baseTypeName
     */
    public function resolveProperty($propertyName, $typeName, $baseTypeName=null)
    {
        $parts = explode('.', $propertyName);
        $propertyLocalName = array_pop($parts);
        $key = implode('.', $parts);
        $type = &$this->types[$key];

        $propertyList = array();
        if ($type['baseType'] === 'Office365\PHP\Client\Runtime\ClientObject') {
            if (!is_null($baseTypeName)) {
                $propertyList["get$propertyLocalName"] = array('name' => $propertyLocalName, 'template' => 'getObjectProperty');
            }
            else {
                $propertyList["get$propertyLocalName"] = array( 'name' => $propertyLocalName, 'template' => 'getValueProperty');
                $propertyList["set$propertyLocalName"] = array( 'name' => $propertyLocalName , 'template' => 'setValueProperty');
            }
        }
        else{
            $propertyList[$propertyLocalName] = array( 'name' => $propertyLocalName, 'template' => null);
        }

        foreach ($propertyList as $name => $property){
            if ($type['state'] === 'detached') {
                $property['state'] = 'detached';
            } else {
                try {
                    $class = new ReflectionClass($type['type']);
                    if(!is_null($property['template']))
                        $class->getMethod($name);
                    else
                        $class->getProperty($name);
                    $property['state']  = 'attached';
                }
                catch (ReflectionException $e) {
                    $property['state'] = 'detached';
                }
            }
            $property['type'] = $this->getPropertyType($typeName,$baseTypeName);
            $property['baseType'] = $baseTypeName;
            $type['properties'][$name] = $property;
        }
    }




    /**
     * @param $typeName string
     * @param $baseTypeName|null string
     * @return string|null
     */
    public function getPropertyType($typeName, $baseTypeName)
    {
        $valueTypeMappings = array(
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
        foreach ($valueTypeMappings as $k=>$v){
            $collTypeMappings["Collection($k)"] = "array";
        }
        $valueTypeMappings = array_merge($valueTypeMappings, $collTypeMappings);


        if (array_key_exists($typeName, $valueTypeMappings))
            return $valueTypeMappings[$typeName];
        elseif (substr($typeName, 0, strlen("Collection")) === "Collection") {
            $colTypeName = str_replace("Collection(","",$typeName);
            $colTypeName = str_replace(")","Collection",$colTypeName);
            if(is_null($baseTypeName))
                $baseTypeName = "ClientValueObjectCollection";
            if ($this->resolveType($colTypeName,$baseTypeName)) {
                $type = $this->types[$colTypeName];
                $type['baseType'] = $type['baseType'] . 'Collection';
                return $type['type'];
            }
            return "array";
        }

        if(is_null($baseTypeName))
            $baseTypeName = "ClientValueObject";
        if ($this->resolveType($typeName,$baseTypeName)) {
            $type = $this->types[$typeName];
            return $type['type'];
        }
        return null;
    }


    /**
     * @var array
     */
    private $types = null;


}
