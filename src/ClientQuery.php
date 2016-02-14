<?php

namespace SharePoint\PHP\Client;

/**
 * ClientQuery
 */
class ClientQuery
{
    private $resultObject;

    private $operationType;

    public function __construct(ClientObject $clientObject,$operationType=ClientOperationType::Read)
    {
        $this->resultObject = $clientObject;
        $this->operationType = $operationType;
    }

    public function buildUrl()
    {
        $resourceUrl = $this->resultObject->getContext()->getUrl();
        $resourceUrl = $resourceUrl .  $this->resultObject->getResourcePath();
        if($this->resultObject->getQueryOptions() != null)
        {
            //todo:append url path from query options 
        }
        return $resourceUrl;
    }

    public function buildData()
    {
        $payload = $this->resultObject->getPayload();
        return ($payload != null ? json_encode($payload) : '');
    }

    

    public function getOperationType()
    {
        return $this->operationType;
    }

    public function initClientObjectFromJson($properties)
    {
        $clientObjectClass = str_replace('Collection','',get_class($this->resultObject));
        
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


    protected function getContext()
    {
        return $this->resultObject->getContext();
    }
    
}