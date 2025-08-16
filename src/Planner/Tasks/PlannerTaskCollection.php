<?php

namespace Office365\Planner\Tasks;

use Office365\EntityCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class PlannerTaskCollection extends EntityCollection {

    public function __construct(ClientRuntimeContext $ctx, ?ResourcePath $resourcePath = null)
    {
        parent::__construct($ctx, $resourcePath, PlannerTask::class);
    }

}