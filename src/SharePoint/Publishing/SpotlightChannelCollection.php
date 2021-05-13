<?php


namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;
use Office365\SharePoint\BaseEntityCollection;

class SpotlightChannelCollection extends BaseEntityCollection
{
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, SpotlightChannel::class, $parent);
    }

}