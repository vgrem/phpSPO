<?php


namespace Office365\PHP\Client\Runtime;

/**
 * Represents OData complex type of a server-side property value.
 */
class ClientValueObject
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

    public function getProperty($name)
    {
        return $this->{$name};
    }

    public function getTypeName()
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
     * @param array $json
     */
    function mapJson($json)
    {
        foreach ($json as $key => $val) {
            $this->setProperty($key,$val);
        }
    }

    /**
     * @return bool
     */
    function getServerObjectIsNull()
    {
        return !is_null($this->typeName);
    }


    /**
     * @var $typeName string
     */
    private $typeName;

}
