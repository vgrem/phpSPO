<?php


namespace SharePoint\PHP\Client;


class ContentType extends ClientObject
{



    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }




}