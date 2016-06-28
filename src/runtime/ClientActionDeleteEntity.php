<?php


namespace SharePoint\PHP\Client;


class ClientActionDeleteEntity extends ClientAction
{
    public function __construct($resourceUrl)
    {
        parent::__construct($resourceUrl, null, (int)HttpMethod::Delete);
    }
}