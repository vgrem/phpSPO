<?php


namespace Office365\SharePoint;



use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

/**
 * Specifies a collection of Recycle Bin items.
 */
class RecycleBinItemCollection extends BaseEntityCollection
{
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, RecycleBinItem::class, $parent);
    }

}
