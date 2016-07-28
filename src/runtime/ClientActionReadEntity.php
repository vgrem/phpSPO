<?php


namespace SharePoint\PHP\Client;

class ClientActionReadEntity extends ClientAction
{
    /**
     * ClientActionUpdateMethod constructor.
     * @param string $resourceUrl
     */
    public function __construct($resourceUrl)
    {
        parent::__construct($resourceUrl,null,ClientActionType::ReadEntry);
    }
}