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
        return true;
    }


    /**
     * @param $typeName string
     * @return ReflectionClass|null
     */
    private function tryResolveClass($typeName)
    {
        try {
            $parts = explode('.', $typeName);
            array_shift($parts);
            $className = $this->options['rootNamespace'] . '\\' . implode('\\', $parts);
            return new ReflectionClass($className);
        } catch (\ReflectionException $ex) {
            return null;
        }
    }


    /**
     * @param $typeName string
     * @param $typeProperties array
     */
    public function resolveType($typeName, $typeProperties)
    {
        if ($this->validateType($typeName)) {
            $typeClass = $this->tryResolveClass($typeName);
            if ($typeClass) {
                foreach ($typeProperties as $propName => $propTypeName) {
                    $typeProperties[$propName] = $this->resolveProperty($typeClass, $propName, $propTypeName);
                }
                $type = array('state' => 'attached', 'type' => $typeClass->getName(), 'file' => $typeClass->getFileName(), 'properties' => $typeProperties);
                $this->types[$typeName] = $type;
            } else {
                foreach ($typeProperties as $propName => $propTypeName) {
                    $typeProperties[$propName] = array('state' => 'detached', 'type' => $this->resolvePropertyType($propTypeName));
                }
                $parts = explode('.', $typeName);
                array_shift($parts);
                $outputFile = $this->options['outputPath'] . "\\" . implode('\\', $parts) . ".php";
                $className = $this->options['rootNamespace'] . "\\" . implode('\\', $parts);
                $type = array('state' => 'detached', 'type' => $className, 'file' => $outputFile, 'properties' => $typeProperties);
                $this->types[$typeName] = $type;
            }
        } else {
            //echo "Unknown type: $typeName" . PHP_EOL;
        }
    }

    /**
     * @param $typeName string
     * @return string|null
     */
    private function resolvePropertyType($typeName)
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
            $propClass = $this->tryResolveClass($typeName);
            return $propClass ? $propClass->getName() : null;
        }
        return null;
    }

    /**
     * @param $class ReflectionClass
     * @param $name string
     * @param $type string
     * @return array
     */
    private function resolveProperty($class, $name, $type)
    {
        try {
            $prop = $class->getProperty($name);
            return array('name' => $name, 'state' => 'attached', 'type' => $this->resolvePropertyType($type));
        } catch (ReflectionException $ex) {
            return array('name' => $name, 'type' => $this->resolvePropertyType($type), 'state' => 'detached');
        }
    }

    /**
     * @var array
     */
    private $types = null;
}
