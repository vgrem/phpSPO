<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;
use Office365\EntityCollection;
use Office365\Planner\Plans\PlannerPlan;
use Office365\Planner\Tasks\PlannerTask;
use Office365\Runtime\ResourcePath;

class PlannerUser extends Entity
{
    /**
     * @return EntityCollection
     */
    public function getTasks()
    {
        return $this->getProperty("tasks",
            new EntityCollection($this->getContext(),
                new ResourcePath("tasks", $this->getResourcePath()),PlannerTask::class));
    }

    /**
     * @return EntityCollection
     */
    public function getPlans()
    {
        return $this->getProperty("plans",
            new EntityCollection($this->getContext(),
                new ResourcePath("plans", $this->getResourcePath()),PlannerPlan::class));
    }
}