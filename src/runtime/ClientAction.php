<?php

namespace SharePoint\PHP\Client;


/**
 * OData query class
 */
abstract class ClientAction
{
    /**
     * @var int
     */
    private $actionType;

    /**
     * @var string
     */
    private $resourceUrl;

    /**
     * @var string
     */
    private $payload;


    /**
     * @var int
     */
    private $payloadFormatType;


    /**
     * ClientAction constructor.
     * @param string $resourceUrl
     * @param string $payload
     * @param int $methodType
     */
    public function __construct($resourceUrl, $payload=null, $methodType=null)
    {
        $this->resourceUrl = $resourceUrl;
        $this->payload = $payload;
        $this->actionType = $methodType;
        $this->payloadFormatType = FormatType::Json;
    }


    /**
     * @return int
     */
    public function getPayloadFormatType(){
        return $this->payloadFormatType;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }


    /**
     * @return string
     */
    public function getResourceUrl(){
        return $this->resourceUrl;
    }


    public function getPayload(){
        return $this->payload;
    }


    /**
     * @return int
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * @param int $value
     */
    public function setPayloadFormatType($value)
    {
        $this->payloadFormatType = $value;
    }
}

