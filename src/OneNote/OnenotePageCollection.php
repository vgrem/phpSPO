<?php


namespace Office365\OneNote;



use Office365\EntityCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class OnenotePageCollection extends EntityCollection
{
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null)
    {
        parent::__construct($ctx, $resourcePath, OnenotePage::class);
    }

}