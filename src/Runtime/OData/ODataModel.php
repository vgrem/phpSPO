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

    public function addType($typeName,array $type)
    {
        $this->types[$typeName] = &$type;
    }


    /**
     * @param $typeName string
     * @return bool
     */
    public function resolveType($typeName)
    {
        if (!$this->validateType($typeName)) {
            //echo "Unknown type: $typeName" . PHP_EOL;
            return false;
        }

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
        $this->addType($typeName,$type);
        return true;
    }

    /**
     * @param $propertyFullName string
     * @param $propertyTypeName string
     */
    public function resolveProperty($propertyFullName, $propertyTypeName)
    {
        $parts = explode('.', $propertyFullName);
        $propertyName = array_pop($parts);
        $typeName = implode('.',$parts);
        $type = &$this->types[$typeName];
        if ($type['state'] === 'detached') {
            $prop = array('state' => 'detached', 'type' => $this->getPropertyType($propertyTypeName));
        } else {
            try {
                $class = new ReflectionClass($type['type']);
                $class->getProperty($propertyName);
                $prop = array('name' => $propertyName, 'state' => 'attached', 'type' => $this->getPropertyType($propertyTypeName));
            }
            catch (ReflectionException $e) {
                $prop = array('name' => $propertyName, 'type' => $this->getPropertyType($propertyTypeName), 'state' => 'detached');
            }
        }
        $type['properties'][$propertyName] = $prop;
    }

    /**
     * @param $typeName string
     * @return string|null
     */
    private function getPropertyType($typeName)
    {
        $mappings = array(
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
        if (array_key_exists($typeName, $mappings))
            return $mappings[$typeName];
        elseif (substr($typeName, 0, strlen("Collection")) === "Collection")
            return "array";
        if ($this->validateType($typeName)) {
            $type = $this->resolveType($typeName);
            return $type ? $type['type'] : null;
        }
        return null;
    }


    /**
     * @var array
     */
    private $types = null;


}
