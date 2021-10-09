<?php


namespace Office365\Runtime\OData\V3;

use Office365\Runtime\OData\ODataFormat;
use Office365\Runtime\OData\ODataMetadataLevel;

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
