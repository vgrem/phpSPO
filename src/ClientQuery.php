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

    public function setClientObjectProperties($properties)
    {
        $ctx = $this->resultObject->getContext();
        if(isset($properties->results)){
            foreach($properties->results as $item){
                $clientObject = new ListItem($ctx);
                $clientObject->setProperties($item);
                $this->resultObject->addChild($clientObject);
            }
        }
        else {
            $this->resultObject->setProperties($properties);
        }
    }
    
}