<?php


namespace Office365\PHP\Client\Runtime\OData;



use Office365\PHP\Client\Runtime\IEntityType;


class JsonLightFormat extends ODataFormat
{


    public function __construct($metadataLevel)
    {
        parent::__construct($metadataLevel);
        if($metadataLevel === ODataMetadataLevel::Verbose){
            $this->Annotations['__deferred'] = "deferred";
            $this->Annotations['__metadata'] = "metadata";
            $this->Annotations['collection'] = "results";
            $this->Annotations['security'] = "d";
        }
    }

    public function setFunctionAnnotation($fnName){
        $this->Annotations['function'] = $fnName;
    }

    /**
     * @param $type IEntityType
     * @param $payload array
     */
    public function ensureMetadataAnnotation($type, &$payload)
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
