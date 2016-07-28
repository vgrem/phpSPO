<?php


namespace SharePoint\PHP\Client;


class ClientActionCreateEntity extends ClientAction
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param ClientObject $clientObject
     * @param ClientValueObject|ClientObject $parameters
     */
    public function __construct(ClientObject $clientObject, $parameters = null)
    {
        $payload = null;
        if($parameters instanceof ClientObject)
            $payload = $parameters->getPayload();
        else if($parameters instanceof ClientValueObject){
            if($parameters instanceof FileCreationInformation)
                $payload = $parameters->Content;
            else
                $payload = $parameters->toJson();
        }


        parent::__construct($clientObject->getResourceUrl(), $payload, (int)ClientActionType::CreateEntry);
    }

}