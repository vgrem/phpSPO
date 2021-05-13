<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;
use Office365\Common\IdentitySet;
use Office365\Runtime\ResourcePath;
/**
 * The **plannerPlan** resource represents a plan in Office 365. A plan can be owned by a [group](group.md) and contains a collection of [plannerTasks](plannertask.md). It can also have a collection of [plannerBuckets](plannerbucket.md). Each plan object has a [details](plannerplandetails.md) object that can contain more information about the plan. For more information about the relationships between groups, plans, and tasks, see [Planner](planner-overview.md).
 */
class PlannerPlan extends Entity
{
    /**
     * Read-only. The user who created the plan.
     * @return IdentitySet
     */
    public function getCreatedBy()
    {
        return $this->getProperty("CreatedBy", new IdentitySet());
    }
    /**
     * Read-only. The user who created the plan.
     * @var IdentitySet
     */
    public function setCreatedBy($value)
    {
        $this->setProperty("CreatedBy", $value, true);
    }
    /**
     * ID of the [Group](group.md) that owns the plan. A valid group must exist before this field can be set. After it is set, this property can’t be updated.
     * @return string
     */
    public function getOwner()
    {
        return $this->getProperty("Owner");
    }
    /**
     * ID of the [Group](group.md) that owns the plan. A valid group must exist before this field can be set. After it is set, this property can’t be updated.
     * @var string
     */
    public function setOwner($value)
    {
        $this->setProperty("Owner", $value, true);
    }
    /**
     * Required. Title of the plan.
     * @return string
     */
    public function getTitle()
    {
        return $this->getProperty("Title");
    }
    /**
     * Required. Title of the plan.
     * @var string
     */
    public function setTitle($value)
    {
        $this->setProperty("Title", $value, true);
    }
    /**
     *  Read-only. Nullable. Additional details about the plan.
     * @return PlannerPlanDetails
     */
    public function getDetails()
    {
        return $this->getProperty("Details",
            new PlannerPlanDetails($this->getContext(),new ResourcePath("Details", $this->getResourcePath())));
    }
}