<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;
use Office365\EntityCollection;
use Office365\Planner\Plans\PlannerPlan;
use Office365\Planner\Tasks\PlannerTaskCollection;
use Office365\Runtime\ResourcePath;

class PlannerUser extends Entity
{
    /**
     * @return PlannerTaskCollection
     */
    public function getTasks()
    {
        return $this->getProperty("Tasks",
            new PlannerTaskCollection($this->getContext(),
                new ResourcePath("Tasks", $this->getResourcePath())));
    }

    /**
     * @return EntityCollection
     */
    public function getPlans()
    {
        return $this->getProperty("Plans",
            new EntityCollection($this->getContext(),
                new ResourcePath("Plans", $this->getResourcePath()),PlannerPlan::class));
    }
}