<?php


namespace SharePoint\PHP\Client;


class ClientActionUpdateEntity extends ClientAction
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param ClientObject $clientObject
     */
    public function __construct(ClientObject $clientObject)
    {
        parent::__construct($clientObject->getResourceUrl(), $clientObject->convertToPayload(), (int)ClientActionType::UpdateEntity);
    }
}