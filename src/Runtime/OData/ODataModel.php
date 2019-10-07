<?php


namespace Office365\PHP\Client\Runtime\OData;
use ReflectionClass;
use ReflectionException;


class ODataModel
{

    public  function getTypes(){
        return $this->types;
    }


    /**
     * @param $typeName string
     * @param $className string
     * @return bool
     */
    private function validateType($typeName,&$className)
    {
        $parts = explode('.', $typeName);
        $base = "Office365\PHP\\Client\\";
        if (count($parts) < 2 || $parts[0] !== "SP")
            return false;
        $rootNs = array_shift($parts);
        $fixedTypeName = implode('\\', $parts);
        $className = $base . "SharePoint\\$fixedTypeName";
        return true;
    }


    /**
     * @param $typeName string
     * @param $properties array
     */
    public function tryResolveType($typeName, $properties)
    {
        if ($this->validateType($typeName, $className)) {
            try {
                $class = new ReflectionClass($className);
                $this->tryResolveProperty($class, $properties);
                $type = array('state' => 'attached', 'file' => $class->getFileName(), 'properties' => $properties);
                $this->types[$typeName] = $type;
            } catch (\ReflectionException $ex) {
                foreach ($properties as $name => $propTypeName) {
                    $properties[$name] = array('state' => 'detached', 'type' => $this->getPrimitiveType($propTypeName));
                }
                $type = array('state' => 'detached', 'file' => null, 'properties' => $properties);
                $this->types[$typeName] = $type;
            }
        } else {
            //echo "Unknown type: $typeName" . PHP_EOL;
        }
    }

    private function getPrimitiveType($typeName)
    {
        $mappings = array(
            "Edm.String" => "string",
            "Collection(SP.KeyValue)"
        );
        if (array_key_exists($typeName, $mappings))
            return $mappings[$typeName];
        elseif (substr($typeName,0,strlen("Collection")))
            return "array";
        return null;
    }

    /**
     * @param $class ReflectionClass
     * @param $properties array
     */
    private function tryResolveProperty($class,&$properties){
        foreach ($properties as $name=>$type){
            try{
                $prop = $class->getProperty($name);
                $properties[$name] = array('name' => $name, 'state' => 'attached', 'type' => $this->getPrimitiveType($type));
            }
            catch(ReflectionException $ex){
                $properties[$name] = array('name' => $name, 'type'=> $this->getPrimitiveType($type), 'state' => 'detached');
            }
        }
    }

    /**
     * @var array
     */
    private $types = null;
}
