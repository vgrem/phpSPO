<?php


namespace Office365\Runtime;

/**
 * Represents OData complex type of a server-side property value.
 */
class ClientValue
{

    public function __construct()
    {
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    function setProperty($name, $value)
    {
        $name = ucfirst($name);
        if(property_exists($this,$name)) {
            $childProperty = $this->getProperty($name);
            if($childProperty instanceof ClientValue){
                foreach ($value as $k=>$v){
                    $childProperty->setProperty($k,$v);
                }
                $this->{$name} = $childProperty;
            }
            else
                $this->{$name} = $value;
        }
        else
            $this->{$name} = $value;
    }

    /**
     * @param string $name
     * @param mixed|null $defaultValue
     * @return mixed
     */
    public function getProperty($name, $defaultValue=null)
    {
        if(isset($this->{$name}))
            return $this->{$name};
        return $defaultValue;
    }


    /**
     * @return string
     */
    public function getServerTypeName()
    {
        return null;
    }

    /**
     * @return array
     */
    function toJson()
    {
        $payload = array();
        foreach (get_object_vars($this) as $key => $val) {
            if (!is_null($val))
                $payload[$key] = $val;
        }
        return $payload;
    }

}
