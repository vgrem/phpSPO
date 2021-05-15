<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 *  "The permissions of a user with whom the calendar is shared."
 */
class CalendarPermission extends Entity
{
    /**
     *  `True` if the user can be removed from the list of sharees or delegates for the specified calendar, `false` otherwise. The "My organization" user determines the permissions other people within your organization have to the given calendar. You cannot remove "My organization" as a sharee to a calendar.
     * @return bool
     */
    public function getIsRemovable()
    {
        if (!$this->isPropertyAvailable("IsRemovable")) {
            return null;
        }
        return $this->getProperty("IsRemovable");
    }
    /**
     *  `True` if the user can be removed from the list of sharees or delegates for the specified calendar, `false` otherwise. The "My organization" user determines the permissions other people within your organization have to the given calendar. You cannot remove "My organization" as a sharee to a calendar.
     * @var bool
     */
    public function setIsRemovable($value)
    {
        $this->setProperty("IsRemovable", $value, true);
    }
    /**
     *  True if the user in context (sharee or delegate) is inside the same organization as the calendar owner.
     * @return bool
     */
    public function getIsInsideOrganization()
    {
        if (!$this->isPropertyAvailable("IsInsideOrganization")) {
            return null;
        }
        return $this->getProperty("IsInsideOrganization");
    }
    /**
     *  True if the user in context (sharee or delegate) is inside the same organization as the calendar owner.
     * @var bool
     */
    public function setIsInsideOrganization($value)
    {
        $this->setProperty("IsInsideOrganization", $value, true);
    }
}