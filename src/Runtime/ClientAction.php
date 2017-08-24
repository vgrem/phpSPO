<?php

namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;


/**
 * OData query class
 */
abstract class ClientAction
{

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
     */
    public function __construct(ResourcePath $resourcePath, $payload=null)
    {
        $this->ResourcePath = $resourcePath;
        $this->Payload = $payload;
        $this->PayloadFormatType = FormatType::Json;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }

}

