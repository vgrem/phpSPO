<?php


namespace SharePoint\PHP\Client;


class ClientActionUpdateEntity extends ClientAction
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param string $resourceUrl
     * @param null|string $payload
     */
    public function __construct($resourceUrl,$payload)
    {
        parent::__construct($resourceUrl, $payload, (int)HttpMethod::Merge);
    }
}