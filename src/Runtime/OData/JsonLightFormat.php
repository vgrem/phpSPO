<?php


namespace Office365\PHP\Client\Runtime\OData;



use Office365\PHP\Client\Runtime\IEntityType;


class JsonLightFormat extends ODataFormat
{

    public function __construct($metadataLevel)
    {
        parent::__construct($metadataLevel);
        if($metadataLevel === ODataMetadataLevel::Verbose){
            $this->addProperty('deferred',"__deferred");
            $this->addProperty('metadata',"__metadata");
            $this->addProperty('collection',"results");
            $this->addProperty('security',"d");
        }
    }


    public  function getFunctionProperty(){
        return $this->getProperty('function');
    }

    public  function getSecurityProperty(){
        return $this->getProperty('security');
    }

    /**
     * @param $type IEntityType
     * @param $payload array
     */
    public function ensureMetadataProperty($type, &$payload)
    {
        $typeName = $type->getTypeName();
        if (substr($typeName, 0, 3) !== "SP.")
            $typeName = "SP." . $typeName;
        $payload["__metadata"] = array("type" => $typeName);
    }


    public function getMediaType()
    {
        return "application/json; OData={$this->MetadataLevel}";
    }

}
