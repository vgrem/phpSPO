<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;

/**
 * The **plannerBucket** resource represents a bucket (or "custom column") for tasks in a plan in Office 365. It is contained in a [plannerPlan](plannerplan.md) and can have a collection of [plannerTasks](plannertask.md).
 */
class PlannerBucket extends Entity
{
    /**
     * Name of the bucket.
     * @return string
     */
    public function getName()
    {
        return $this->getProperty("Name");
    }

    /**
     * Name of the bucket.
     *
     * @return self
     * @var string
     */
    public function setName($value)
    {
        return $this->setProperty("Name", $value, true);
    }
    /**
     * Plan ID to which the bucket belongs.
     * @return string
     */
    public function getPlanId()
    {
        return $this->getProperty("PlanId");
    }
    /**
     * Plan ID to which the bucket belongs.
     * @var string
     */
    public function setPlanId($value)
    {
        $this->setProperty("PlanId", $value, true);
    }
    /**
     * Hint used to order items of this type in a list view. The format is defined as outlined [here](planner-order-hint-format.md).
     * @return string
     */
    public function getOrderHint()
    {
        return $this->getProperty("OrderHint");
    }
    /**
     * Hint used to order items of this type in a list view. The format is defined as outlined [here](planner-order-hint-format.md).
     * @var string
     */
    public function setOrderHint($value)
    {
        $this->setProperty("OrderHint", $value, true);
    }
}