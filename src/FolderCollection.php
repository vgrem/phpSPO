<?php
/**
 * Represents a collection of Folder resources.
 */

namespace SharePoint\PHP\Client;


class FolderCollection extends ClientObjectCollection
{
    public function add($url)
    {
        $folder = new Folder(
            $this->getContext(),
            $this->getResourcePath()
        );
        $folder->setProperty("ServerRelativeUrl",rawurlencode($url));
        $qry = new ClientAction($this->getResourceUrl(),$folder->toJson(),HttpMethod::Post);
        $this->getContext()->addQuery($qry,$folder);
        return $folder;
    }
}