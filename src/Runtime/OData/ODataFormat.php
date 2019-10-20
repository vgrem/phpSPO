<?php


namespace Office365\PHP\Client\Runtime\OData;


abstract class ODataFormat
{


    public function __construct($metadataLevel)
    {
        $this->MetadataLevel = $metadataLevel;
        $this->properties = array();

    }


    public function addProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }


    public function getProperty($name){
        if(isset($this->properties[$name]))
            return $this->properties[$name];
        return null;
    }


    /**
     * @return string
     */
    public abstract function getMediaType();


    /**
     * @return bool
     */
    public function isJson()
    {
       if($this instanceof JsonFormat || $this instanceof JsonLightFormat)
           return true;
        return false;
    }


    /**
     * @return bool
     */
    public function isAtom()
    {
        if($this instanceof AtomFormat)
            return true;
        return false;
    }

    /**
     * Controls information from the payload
     * @var int
     */
    public $MetadataLevel;

    /**
     * @var array
     */
    protected $properties;

}
