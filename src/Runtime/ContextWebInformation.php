<?php

namespace SharePoint\PHP\Client\Runtime;


/**
 * The context information for a site.
 */
class ContextWebInformation extends ODataEntity
{

    /**
     * @param \stdClass $payload
     * @param ODataFormat $format
     */
    function convertToEntity($payload, ODataFormat $format)
    {
        if($format->MetadataLevel == ODataMetadataLevel::Verbose)
            $payload = $payload->GetContextWebInformation;
        parent::convertToEntity($payload,$format);
    }


    /**
     * @return int
     */
    function getPayloadType()
    {
        return ODataPayloadKind::Value;
    }

    /**
     * @return \stdClass
     */
    function convertToPayload()
    {
        return null;
    }
    
    /**
     * The form digest value.
     * @var string
     */
    public $FormDigestValue;


    /**
     * The library version.
     * @var string
     */
    public $LibraryVersion;


    /**
     * The amount of time in seconds that the form digest will timeout.
     * @var int
     */
    public $FormDigestTimeoutSeconds;

    /**
     * The full URL of the site collection context.
     * @var string
     */
    public $SiteFullUrl;

    /**
     * The supported client-side object model request schema version.
     * @var array
     */
    public $SupportedSchemaVersions;


    /**
     * The full URL of the site context.
     * @var string
     */
    public $WebFullUrl;



}