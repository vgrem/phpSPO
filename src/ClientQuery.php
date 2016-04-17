<?php

namespace SharePoint\PHP\Client;

/**
 * ClientQuery
 */
class ClientQuery
{
    private $resultObject;

    private $operationType;

    private $operationEndpoint;

    private $operationParameters;

    private $binaryStringRequestBody;

    public function __construct(ClientObject $clientObject,$operationType=ClientOperationType::Read,$operationEndpoint=null,$operationParameters=null)
    {
        $this->resultObject = $clientObject;
        $this->operationType = $operationType;
        $this->operationEndpoint = $operationEndpoint;
        $this->operationParameters = $operationParameters;
        $this->binaryStringRequestBody = false;
    }

    

    public function buildUrl()
    {
        $url = $this->resultObject->getContext()->getUrl();
        $url = $url .  $this->resultObject->getResourcePath();
        if(!is_null($this->operationEndpoint)) $url = $url . $this->operationEndpoint;
        if($this->resultObject->getQueryOptions() != null)
        {
            //todo:append url path from query options
        }
        return $url;
    }

    public function prepareData()
    {
        $payload = $this->resultObject->getPayload();
        if($this->binaryStringRequestBody)
            return $payload;
        return !is_null($payload) ? json_encode($payload) : '';
    }

    

    public function getOperationType()
    {
        return $this->operationType;
    }



    public function initClientObjectFromJson($properties)
    {
        $clientObjectClass = str_replace('Collection','',get_class($this->resultObject));
        if($clientObjectClass == "SharePoint\PHP\Client\List") $clientObjectClass = "SharePoint\PHP\Client\SPList";
        
        $ctx = $this->getContext();
        if(isset($properties->results)){
            foreach($properties->results as $item){
                $clientObject = new $clientObjectClass($ctx);
                $clientObject->fromJson($item);
                $this->resultObject->addChild($clientObject);
            }
        }
        else {
            $this->resultObject->fromJson($properties);
        }
    }


    public function getContext()
    {
        return $this->resultObject->getContext();
    }

    public function setBinaryStringRequestBody($value)
    {
        $this->binaryStringRequestBody = $value;
    }


}

