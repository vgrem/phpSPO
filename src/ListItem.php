<?php

namespace SharePoint\PHP\Client;

/**
 * ListItem client object
 */
class ListItem extends ClientObject
{
    public function update($listItemUpdationInformation)
    {
        $this->payload = $listItemUpdationInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    public function deleteObject()
    {
        $qry = new ClientQuery($this,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }
}