<?php


namespace Office365\PHP\Client\Runtime;


class UpdateEntityQuery extends ClientAction
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param ClientObject $clientObject
     */
    public function __construct(ClientObject $clientObject)
    {
        parent::__construct($clientObject->getResourcePath(), $clientObject);
    }
}