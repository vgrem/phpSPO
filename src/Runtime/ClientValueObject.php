<?php


namespace Office365\PHP\Client\Runtime;

use Office365\PHP\Client\Runtime\OData\JsonLightFormat;
use Office365\PHP\Client\Runtime\OData\ODataFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;


/**
 * Represents OData complex type of a server-side property value.
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
     * @param bool $serializable
     */
    function setProperty($name, $value, $serializable = true)
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

    function toJson(ODataFormat $format)
    {
        $payload = array();
        foreach (get_object_vars($this) as $key => $val) {
            if ($key != 'typeName' && !is_null($val))
                $payload[$key] = $val;
        }
        if ($format instanceof JsonLightFormat && $format->MetadataLevel == ODataMetadataLevel::Verbose) {
            $format->ensureMetadataProperty($this, $payload);
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
     * @var $typeName string
     */
    private $typeName;


}
