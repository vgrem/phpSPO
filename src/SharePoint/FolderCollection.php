<?php
/**
 * Represents a collection of Folder resources.
 */

namespace SharePoint\PHP\Client;


class FolderCollection extends ClientObjectCollection
{
    public function add($url)
    {
        $folder = new Folder($this->getContext());
        $folder->setProperty("ServerRelativeUrl",rawurlencode($url));
        $qry = new ClientActionCreateEntity($this,$folder);
        $this->getContext()->addQuery($qry,$folder);
        return $folder;
    }
}