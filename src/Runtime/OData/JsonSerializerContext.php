<?php


namespace Office365\PHP\Client\Runtime\OData;


use Office365\PHP\Client\Runtime\IEntityTypeCollection;

class JsonSerializerContext extends ODataSerializerContext
{

    public function __construct($metadataLevel)
    {
        parent::__construct($metadataLevel);
        $this->Streaming = false;
        $this->IEEE754Compatible = true;
    }

    function isAnnotationProperty($key)
    {
        return substr( $key, 0, 7 ) === "@odata.";
    }


    function mapType($json, $type)
    {
        foreach ($json as $key => $val) {
            if ($this->isAnnotationProperty($key)){
                unset($json->{$key});
            }
        }
        parent::mapType($json, $type);
    }

    function  mapTypeCollection($json, IEntityTypeCollection $resultTypeCollection)
    {
        $collectionTagName = "value";
        if (property_exists($json, $collectionTagName)) {
            $json = $json->{$collectionTagName};
        }
        parent::mapTypeCollection($json, $resultTypeCollection);
    }


    /**
     * @return string
     * @throws \Exception
     */
    public function getMediaType()
    {
        $streamingValue = var_export($this->Streaming,true);
        $IEEE754CompatibleValue = var_export($this->IEEE754Compatible,true);
        switch($this->MetadataLevel){
            case ODataMetadataLevel::Verbose:
                $metadataValue = "full";
                break;
            case ODataMetadataLevel::MinimalMetadata:
                $metadataValue = "minimal";
                break;
            case ODataMetadataLevel::NoMetadata:
                $metadataValue = "none";
                break;
            default:
                throw  new \Exception("Unsupported metadata");
                break;
        }
        return "application/json;OData.metadata={$metadataValue};OData.streaming={$streamingValue};IEEE754Compatible={$IEEE754CompatibleValue}";
    }

    /**
     * @var bool
     */
    public $Streaming;


    /**
     * @var bool
     */
    public $IEEE754Compatible;


}