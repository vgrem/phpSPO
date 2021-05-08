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
