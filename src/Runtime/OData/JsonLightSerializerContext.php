<?php


namespace Office365\PHP\Client\Runtime\OData;



use Office365\PHP\Client\Runtime\IEntityType;
use Office365\PHP\Client\SharePoint\CamlQuery;
use Office365\PHP\Client\SharePoint\ChangeLogItemQuery;
use Office365\PHP\Client\SharePoint\ChangeQuery;
use Office365\PHP\Client\SharePoint\WebCreationInformation;

class JsonLightSerializerContext extends ODataSerializerContext
{

    const DeferredTag = "__deferred";
    const QueryTag = "query";
    const ParametersTag = "parameters";
    const CollectionTag = "results";
    const MetadataTag = "__metadata";
    const SecurityTag = "d";

    public function __construct($metadataLevel)
    {
        parent::__construct($metadataLevel);
    }


    function map($json, &$resultObject)
    {
        $json = $this->denormalyzePayload($json,JsonLightSerializerContext::SecurityTag);
        parent::map($json, $resultObject);
    }



    function denormalyzePayload($json, $parentTag){
        if ($this->MetadataLevel == ODataMetadataLevel::Verbose
            && property_exists($json, $parentTag)) {
            $json = $json->{$parentTag};
        }

       if(is_array($json)){
            foreach ($json as $idx => $item) {
                if(!is_scalar($item))
                    $json[$idx] = $this->denormalyzePayload($item,null);
            }
        }
        else{
            foreach ($json as $key => $val) {
                if ($this->isMetadataProperty($key)){
                    unset($json->{$key});
                    continue;
                }

                if(is_object($val)) {
                    if ($this->isDeferredProperty($json->{$key})) {
                        $json->{$key} = null;
                    } else {
                        $json->{$key} = $this->denormalyzePayload($val,null);
                    }
                }
                elseif (is_array($val)){
                    if($this->MetadataLevel === ODataMetadataLevel::NoMetadata)
                        $json->{$key} = $this->denormalyzePayload($val,null);
                    else
                        $json = $this->denormalyzePayload($json,$key);
                }
            }
        }
        return $json;
    }



    public function getMediaType()
    {
        return "application/json; OData={$this->MetadataLevel}";
    }



    public function normalize($value)
    {
        $payload = parent::normalize($value);
        if ($value instanceof IEntityType) {
            $this->ensureMetadata($value, $payload); //ensure metadata
            $this->ensureContainer($value, $payload); //ensure parent container
        }
        return $payload;
    }


    /**
     * @param IEntityType $value
     * @param $payload
     */
    private function ensureContainer(IEntityType $value, &$payload)
    {
        if ($value instanceof CamlQuery || $value instanceof ChangeQuery || $value instanceof ChangeLogItemQuery)
            $payload = array("query" => $payload);
        else if ($value instanceof WebCreationInformation)
            $payload = array("parameters" => $payload);
    }

    /**
     * @param IEntityType $value
     * @param $payload
     */
    private function ensureMetadata(IEntityType $value, &$payload)
    {
        if ($this->MetadataLevel == ODataMetadataLevel::Verbose) {
            $metadataTypeName = $value->getTypeName();
            if (substr($metadataTypeName, 0, 3) !== "SP.")
                $metadataTypeName = "SP." . $metadataTypeName;
            $payload["__metadata"] = array("type" => $metadataTypeName);
        }
    }


    /**
     * @param $value
     * @return bool
     */
    protected function isDeferredProperty($value)
    {
        if (isset($value->__deferred))
            return true;
        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    protected function isMetadataProperty($key)
    {
        return ($key === JsonLightSerializerContext::MetadataTag);
    }

}