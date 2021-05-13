<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;
/**
 * The **plannerPlanDetails** resource represents the additional information about a plan. Each [plan](plannerplan.md) object has a details object.
 */
class PlannerPlanDetails extends Entity
{
    /**
     * Set of user ids that this plan is shared with. If you are leveraging Office 365 Groups, use the Groups API to manage group membership to share the [group's](group.md) plan. You can also add existing members of the group to this collection though it is not required for them to access the plan owned by the group. 
     * @return PlannerUserIds
     */
    public function getSharedWith()
    {
        return $this->getProperty("SharedWith", new PlannerUserIds());
    }
    /**
     * Set of user ids that this plan is shared with. If you are leveraging Office 365 Groups, use the Groups API to manage group membership to share the [group's](group.md) plan. You can also add existing members of the group to this collection though it is not required for them to access the plan owned by the group. 
     * @var PlannerUserIds
     */
    public function setSharedWith($value)
    {
        $this->setProperty("SharedWith", $value, true);
    }
    /**
     * An object that specifies the descriptions of the six categories that can be associated with tasks in the plan
     * @return PlannerCategoryDescriptions
     */
    public function getCategoryDescriptions()
    {
        return $this->getProperty("CategoryDescriptions", new PlannerCategoryDescriptions());
    }
    /**
     * An object that specifies the descriptions of the six categories that can be associated with tasks in the plan
     * @var PlannerCategoryDescriptions
     */
    public function setCategoryDescriptions($value)
    {
        $this->setProperty("CategoryDescriptions", $value, true);
    }
}