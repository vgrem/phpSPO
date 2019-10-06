<?php


namespace Office365\PHP\Client\Runtime\OData;
use http\Exception;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\SharePoint\Web;
use ReflectionClass;
use ReflectionException;


class ODataModel
{

    public  function getTypes(){
        return $this->types;
    }

    /**
     * @param $namespace string
     * @param $name string
     * @return string
     */
    private function getTypeName($namespace, $name)
    {
        return "$namespace.$name";
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
     * @param $namespace string
     * @param $name string
     * @param $properties array
     * @throws ReflectionException
     */
    public function tryResolveType($namespace, $name, $properties)
    {
        /*if($name == "FieldUserValue"){
            echo "OK";
        }*/

        $typeName = $this->getTypeName($namespace, $name);
        if($this->validateType($typeName,$className)){
            try {
                $class = new ReflectionClass($className);
                $this->tryResolveProperty($class,$properties);
                $type = array('state' => 'attached', 'file' => $class->getFileName(), 'properties' => $properties);
                $this->types[$typeName] = $type;
            } catch (\ReflectionException $ex) {
                foreach ($properties as $pName=>$pType){
                    //$properties[$name] = array('state' => 'detached', 'type' => ODataPrimitiveTypeKind::getName($type));
                    $properties[$pName] = array( 'name' => $pName,'state' => 'detached', 'type' => null);
                }

                $ctxClass = new ReflectionClass(ClientContext::class);
                $parts = explode('.', $namespace);
                array_shift($parts);
                $fixedTypeName = implode('\\', $parts);
                $fileName = dirname($ctxClass->getFileName()) . $fixedTypeName . "\\$name.php";
                $type = array('state' => 'detached', 'file' => $fileName, 'properties' => $properties);
                $this->types[$typeName] = $type;
            }
        }
        else{
            //echo "Unknown type: $typeName" . PHP_EOL;
        }
    }

    /**
     * @param $class ReflectionClass
     * @param $properties array
     */
    private function tryResolveProperty($class,&$properties){
        foreach ($properties as $name=>$type){
            try{
                $prop = $class->getProperty($name);
                $properties[$name] = array('name' => $name, 'state' => 'attached', 'type' => null);
                /*if($prop->hasType()){
                    //$properties[$name] = array('state' => 'attached', 'type' => $prop->getType());
                }
                else
                    $properties[$name] = array('state' => 'attached', 'type' => ODataPrimitiveTypeKind::getName($type));*/
            }
            catch(ReflectionException $ex){
                //$propType = ODataPrimitiveTypeKind::getName($type);
                $properties[$name] = array('name' => $name, 'type'=> null, 'state' => 'detached');
            }
        }
    }

    /**
     * @var array
     */
    private $types = null;
}
