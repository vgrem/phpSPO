<?php


namespace Office365\PHP\Client\Runtime\OData;


class JsonLightFormat extends ODataFormat
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


    function getCollectionTagName()
    {
        return "results";
    }



    public function getMediaType()
    {
        return "application/json; OData={$this->MetadataLevel}";
    }

}