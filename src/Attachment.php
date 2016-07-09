<?php


namespace SharePoint\PHP\Client;


class Attachment extends ClientObject
{

    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this->getResourceUrl());
        $this->getContext()->addQuery($qry);
    }

}