<?php


namespace Office365\PHP\Client\Runtime;


/**
 * Represents OData complex type(property) of a server-side property value.
 */
class ClientValueObject implements IEntityType
{

    /**
     * ClientValueObject constructor.
     * @param string $typeName
     */
    public function __construct($typeName = null)
    {
        $this->typeName = $typeName;
    }


    /**
     * @param string $name
     * @param mixed $value
     * @param bool $persistChanges
     */
    function setProperty($name, $value,$persistChanges = true)
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

    function getProperties($flag=SCHEMA_ALL_PROPERTIES)
    {
        $result = array();
        foreach (get_object_vars($this) as $key => $val) {
            if ($key != 'typeName' && !is_null($val))
                $result[$key] = $val;
        }
        return $result;
    }


    /**
     * @var $typeName string
     */
    private $typeName;


}