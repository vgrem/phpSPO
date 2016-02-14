<?php

namespace SharePoint\PHP\Client;

/**
 * Client objects collection
 */
class ClientObjectCollection extends ClientObject
{
    private $data = array();

    public function addChild(ClientObject $clientObject)
    {
        $this->data[] = $clientObject;
    }

    public function getData()
    {
        return $this->data;
    }
}