<?php


namespace Office365\OneDrive;


use Office365\EntityCollection;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;
use stdClass;


class DriveItemCollection extends EntityCollection
{

    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null)
    {
        parent::__construct($ctx, $resourcePath, DriveItem::class);
    }

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