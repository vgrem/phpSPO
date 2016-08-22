<?php
namespace SharePoint\PHP\Client;

use SharePoint\PHP\Client\Runtime\ODataPayload;

class ClientActionCreateEntity extends ClientAction
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param ClientObject $entityCollection
     * @param ODataPayload $payload
     */
    public function __construct(ClientObject $entityCollection, ODataPayload $payload = null)
    {
        parent::__construct($entityCollection->getResourceUrl(), $payload, (int)ClientActionType::CreateEntity);
    }

}