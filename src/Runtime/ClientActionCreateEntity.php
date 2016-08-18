<?php


namespace SharePoint\PHP\Client;




use SharePoint\PHP\Client\Runtime\ODataEntity;

class ClientActionCreateEntity extends ClientAction
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param ClientObject $clientObject
     * @param ClientValueObject $payload
     */
    public function __construct(ClientObject $clientObject, ODataEntity $payload = null)
    {
        parent::__construct($clientObject->getResourceUrl(), $payload, (int)ClientActionType::CreateEntity);
    }

}