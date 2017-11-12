<?php


namespace Office365\PHP\Client\Runtime;


/**
 * Represents OData complex type(property) of a server-side property value.
 */
class ClientValueObject implements ISchemaType
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
        return array_filter(get_object_vars($this), function ($v, $k) {
            return ($k != 'typeName' && !is_null($v));
        }, ARRAY_FILTER_USE_BOTH);
    }


    /**
     * @var $typeName string
     */
    private $typeName;


}