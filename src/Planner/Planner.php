<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;
use Office365\Planner\Plans\PlannerPlanCollection;
use Office365\Runtime\ResourcePath;

class Planner extends Entity
{
    /**
     * @return PlannerPlanCollection
     */
    public function getPlans()
    {
        return $this->getProperty("plans",
            new PlannerPlanCollection($this->getContext(),
                new ResourcePath("plans", $this->getResourcePath()), $this));
    }
}