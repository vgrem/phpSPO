<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;
use Office365\Planner\Buckets\PlannerBucketCollection;
use Office365\Planner\Plans\PlannerPlanCollection;
use Office365\Planner\Tasks\PlannerTaskCollection;
use Office365\Runtime\ResourcePath;

class Planner extends Entity
{
    /**
     * @return PlannerPlanCollection
     */
    public function getPlans()
    {
        return $this->getProperty("Plans",
            new PlannerPlanCollection($this->getContext(),
                new ResourcePath("Plans", $this->getResourcePath()), $this));
    }

    /**
     * @return PlannerTaskCollection
     */
    public function getTasks()
    {
        return $this->getProperty("Tasks",
            new PlannerTaskCollection($this->getContext(),
                new ResourcePath("Tasks", $this->getResourcePath()), $this));
    }

    /**
     * @return PlannerBucketCollection
     */
    public function getBuckets()
    {
        return $this->getProperty("Buckets",
            new PlannerBucketCollection($this->getContext(),
                new ResourcePath("Buckets", $this->getResourcePath()), $this));
    }
}