<?php

/**
 *  2025-08-21T20:35:45+00:00 
 */
namespace Office365\Outlook\Calendars;

use Office365\Entity;
use Office365\Outlook\EmailAddress;

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
    /**
     * @return EmailAddress
     */
    public function getEmailAddress()
    {
        return $this->getProperty("EmailAddress");
    }
    /**
     * @var EmailAddress
     */
    public function setEmailAddress($value)
    {
        return $this->setProperty("EmailAddress", $value, true);
    }
}