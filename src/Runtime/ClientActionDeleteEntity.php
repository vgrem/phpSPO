<?php


namespace SharePoint\PHP\Client;


class ClientActionDeleteEntity extends ClientAction
{

    /**
     * ClientActionDeleteEntity constructor.
     * @param ClientObject $clientObject
     */
    public function __construct(ClientObject $clientObject)
    {
        parent::__construct($clientObject->getResourceUrl(), null, (int)ClientActionType::DeleteEntity);
    }
}