<?php

namespace SharePoint\PHP\Client;

/**
 * ClientQuery
 */
class ClientQuery
{
    protected $resultObject;

    protected $resultValueObject;

    private $actionType;

    private $resourceUrl;

    private $parameters;

    private $binaryStringRequestBody;

    private $responseFormatType;

    public function __construct($resourceUrl, $type=ClientActionType::Read, $parameters=null)
    {
        $this->resultObject = null;
        $this->resourceUrl = $resourceUrl;
        $this->actionType = $type;
        $this->parameters = $parameters;
        $this->binaryStringRequestBody = false;
        $this->responseFormatType = ClientFormatType::Json;
    }


    public function addResultObject(ClientObject $clientObject){
        $this->resultObject = $clientObject;
    }

    public function addResultValue(ClientValueObject $clientValueObject){
        $this->resultValueObject = $clientValueObject;
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
            else if($this->parameters instanceof ClientValueObject){
                //if(isset($this->resultObject))
                //    $this->parameters->setMetadataType($this->resultObject->getEntityTypeName());
                $payload = $this->parameters->toJson();
            }
            else {
                if(isset($this->resultObject))
                    $this->ensureMetadataType($this->resultObject,$this->parameters);
                $payload = json_encode($this->parameters);
            }
        }
        return $payload;
    }

    public function getActionType()
    {
        return $this->actionType;
    }



    public function initClientObjectFromJson($properties)
    {
        $ctx = $this->getContext();
        if(isset($properties->results)){
            foreach($properties->results as $item){
                $clientObject = ClientObject::createTypedObject($ctx,$item);
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


    public function getResultObject()
    {
        return $this->resultObject;
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

    private function ensureMetadataType(ClientObject $clientObject, & $parameters)
    {
        if (array_key_exists('parameters', $parameters)) {
            return $this->ensureMetadataType($clientObject,$parameters['parameters']);
        }
        if (!array_key_exists('__metadata', $parameters)) {
            $parameters['__metadata'] = ['type' => $clientObject->getEntityTypeName()];
        }
        return $parameters;
    }





}

