<?php


namespace Office365\Runtime;

/**
 * Represents OData complex type of a server-side property value.
 */
class ClientValue
{

    /**
     * @param string $typeName
     */
    public function __construct($typeName = null)
    {
        $this->typeName = $typeName;
    }
    /**
     * @param string $name
     * @param mixed $value
     */
    function setProperty($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getProperty($name)
    {
        return $this->{$name};
    }


    /**
     * @return mixed|string
     */
    public function getServerTypeName()
    {
        if(!isset($this->typeName)){
            $typeInfo = explode("\\",get_class($this));
            $this->typeName =  end($typeInfo);
        }
        return $this->typeName;
    }

    /**
     * @return array
     */
    function toJson()
    {
        $payload = array();
        foreach (get_object_vars($this) as $key => $val) {
            if ($key != 'typeName' && !is_null($val))
                $payload[$key] = $val;
        }
        return $payload;
    }

    /**
     * @return bool
     */
    function getServerObjectIsNull()
    {
        return !is_null($this->typeName);
    }


    /**
     * @var ClientRuntimeContext
     */
    private $context;

    /**
     * @var $typeName string
     */
    private $typeName;

}
