<?php

namespace Office365\Planner\Buckets;

use Office365\Entity;
use Office365\EntityCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class PlannerBucketCollection extends EntityCollection
{
    public function __construct(ClientRuntimeContext $ctx, ?ResourcePath $resourcePath = null, ?Entity $parent=null)
    {
        parent::__construct($ctx, $resourcePath, PlannerBucket::class, $parent);
    }

}