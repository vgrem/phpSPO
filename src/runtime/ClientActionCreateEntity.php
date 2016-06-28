<?php


namespace SharePoint\PHP\Client;


class ClientActionCreateEntity extends ClientAction
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param string $resourceUrl
     * @param null|string $payload
     */
    public function __construct($resourceUrl,$payload)
    {
        parent::__construct($resourceUrl, $payload, (int)HttpMethod::Post);
    }

}