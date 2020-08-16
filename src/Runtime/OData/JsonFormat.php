<?php


namespace Office365\Runtime\OData;


use Exception;

class JsonFormat extends ODataFormat
{

    public function __construct($metadataLevel)
    {
        parent::__construct($metadataLevel);
        $this->Streaming = false;
        $this->IEEE754Compatible = true;
        $this->ControlFamilyTag = "@odata";
        $this->CollectionTag = "value";
        $this->TypeTag = "@odata.type";
        $this->NextCollectionTag = "@odata.nextLink";
    }


    /**
     * @return string
     * @throws Exception
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
                throw  new Exception("Unsupported metadata");
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


    /**
     * @var string
     */
    public $TypeTag;


    /**
     * @var string
     */
    public $ControlFamilyTag;


    /**
     * @var string
     */
    public $CollectionTag;


}
