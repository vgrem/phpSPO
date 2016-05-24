<?php

namespace SharePoint\PHP\Client;

/**
 * ClientQuery
 */
class ClientQuery
{
    
    private $actionType;

    private $resourceUrl;

    private $parameters;

    private $binaryStringRequestBody;

    private $responseFormatType;

    public function __construct($resourceUrl, $type=ClientActionType::Read, $parameters=null)
    {
        $this->resourceUrl = $resourceUrl;
        $this->actionType = $type;
        $this->parameters = $parameters;
        $this->binaryStringRequestBody = false;
        $this->responseFormatType = ClientFormatType::Json;
    }
    
    
    public function getId(){
        return spl_object_hash($this);
    } 
    
    
    public function getResourceUrl()
    {
        return $this->resourceUrl;
    }


    public function preparePayload()
    {
        $payload = null;
        if(isset($this->parameters)){
            if($this->binaryStringRequestBody)
                $payload = $this->parameters;
            else if($this->parameters instanceof ClientValueObject || $this->parameters instanceof ClientObject){
                $payload = $this->parameters->toJson();
            }
            else{
                $payload = json_encode($this->parameters);
            }
        }
        return $payload;
    }

    public function getActionType()
    {
        return $this->actionType;
    }

    public function setBinaryStringRequestBody($value)
    {
        $this->binaryStringRequestBody = $value;
    }

    public function setResponseFormatType($value)
    {
        $this->responseFormatType = $value;
    }

    public function getResponseFormatType()
    {
        return $this->responseFormatType;
    }
    
}

