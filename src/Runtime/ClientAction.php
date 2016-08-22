<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataPayload;


/**
 * OData query class
 */
abstract class ClientAction
{
    /**
     * @var int
     */
    public $ActionType;

    /**
     * @var string
     */
    public $ResourceUrl;

    /**
     * @var ODataPayload
     */
    public $Payload;


    /**
     * @var int
     */
    public $ResponsePayloadFormatType;


    /**
     * ClientAction constructor.
     * @param string $resourceUrl
     * @param ODataPayload $payload
     * @param int $methodType
     */
    public function __construct($resourceUrl, $payload=null, $methodType=null)
    {
        $this->ResourceUrl = $resourceUrl;
        $this->Payload = $payload;
        $this->ActionType = $methodType;
        $this->ResponsePayloadFormatType = FormatType::Json;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }

}

