<?php


namespace Office365\Graph;


use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use stdClass;


class DriveItemCollection extends ClientObjectCollection
{

    /**
     * Create a new folder or DriveItem in a Drive with a specified parent item or path.
     * @param string $folderName
     * @return DriveItem
     */
    public function createFolder($folderName)
    {
        $folderItem = new DriveItem($this->getContext());
        $this->addChild($folderItem);
        $payload = array(
            "name" => $folderName,
            "folder" => new stdClass(),
            "@microsoft.graph.conflictBehavior" => ConflictBehavior::Rename
        );
        $qry = new InvokePostMethodQuery($this,null,null,null, $payload);
        $this->getContext()->addQueryAndResultObject($qry, $folderItem);
        return $folderItem;
    }

}