<?php


namespace SharePoint\PHP\Client\Runtime;

abstract class ODataFormat
{


    public function __construct($metadataLevel)
    {
        $this->MetadataLevel = $metadataLevel;
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
     * Controls information from the payload
     * @var int
     */
    public $MetadataLevel;

}