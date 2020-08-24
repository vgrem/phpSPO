<?php
/**
 * Represents a collection of Folder resources.
 */

namespace Office365\SharePoint;


use Office365\Runtime\Actions\CreateEntityQuery;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ResourcePathServiceOperation;

class FolderCollection extends ClientObjectCollection
{
    /**
     * @param string $serverRelativeUrl Folder server relative url
     * @return Folder
     */
    public function add($serverRelativeUrl)
    {
        $folder = new Folder($this->getContext());
        $this->addChild($folder);
        $folder->setProperty("ServerRelativeUrl", rawurlencode($serverRelativeUrl));
        $qry = new CreateEntityQuery($folder);
        $this->getContext()->addQueryAndResultObject($qry, $folder);
        return $folder;
    }

    /**
     * @param $serverRelativeUrl
     * @return Folder
     */
    public function getByUrl($serverRelativeUrl){
        $path = new ResourcePathServiceOperation("getByUrl",array(
            rawurlencode($serverRelativeUrl)
        ),$this->getResourcePath());
        return new Folder($this->getContext(),$path);
    }
}
