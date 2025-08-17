<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;
use Office365\Planner\Plans\PlannerPlanCollection;
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
     * @return PlannerPlanCollection
     */
    public function getPlans()
    {
        return $this->getProperty("Plans",
            new PlannerPlanCollection($this->getContext(),
                new ResourcePath("Plans", $this->getResourcePath()),$this));
    }
}