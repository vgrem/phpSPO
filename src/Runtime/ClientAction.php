<?php

namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;


/**
 * OData query class
 */
class ClientAction
{
    /**
     * @var int
     */
    public $ActionType;

    /**
     * @var ResourcePath
     */
    public $ResourcePath;


    /**
     * @var $QueryOptions ODataQueryOptions
     */
    public $QueryOptions;

    /**
     * @var ODataPayload
     */
    public $Payload;


    /**
     * @var int
     */
    public $PayloadFormatType;


    /**
     * ClientAction constructor.
     * @param ResourcePath $resourcePath
     * @param ODataPayload $payload
     * @param int $actionType
     */
    public function __construct(ResourcePath $resourcePath, $payload=null, $actionType=null)
    {
        $this->ResourcePath = $resourcePath;
        $this->Payload = $payload;
        $this->ActionType = $actionType;
        $this->PayloadFormatType = FormatType::Json;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }

}

