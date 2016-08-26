<?php
/**
 * Represents a collection of Folder resources.
 */

namespace Office365\PHP\Client\SharePoint;


use Office365\PHP\Client\Runtime\ClientActionCreateEntity;
use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\OData\ODataPayload;

class FolderCollection extends ClientObjectCollection
{
    public function add($url)
    {
        $folder = new Folder($this->getContext());
        $folder->setProperty("ServerRelativeUrl",rawurlencode($url));
        $qry = new ClientActionCreateEntity($this, ODataPayload::createFromObject($folder));
        $this->getContext()->addQuery($qry,$folder);
        return $folder;
    }
}