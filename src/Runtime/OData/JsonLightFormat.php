<?php


namespace Office365\Runtime\OData;

class JsonLightFormat extends ODataFormat
{

    public function __construct($metadataLevel = ODataMetadataLevel::Verbose)
    {
        parent::__construct($metadataLevel);
        $this->DeferredTag = "__deferred";
        $this->MetadataTag = "__metadata";
        $this->CollectionTag = "results";
        $this->NextCollectionTag = "__next";
        $this->SecurityTag ="d";
    }



    public function getMediaType()
    {
        return "application/json; OData={$this->MetadataLevel}";
    }


    /**
     * @var string
     */
    public $DeferredTag;

    /**
     * @var string
     */
    public $MetadataTag;

    /**
     * @var string
     */
    public $SecurityTag;

    /**
     * @var string
     */
    public $FunctionTag;

}
