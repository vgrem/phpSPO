<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 *  "Represents an unassigned open shift in a schedule."
 */
class OpenShift extends Entity
{
    /**
     * ID for the scheduling group that the open shift belongs to.
     * @return string
     */
    public function getSchedulingGroupId()
    {
        if (!$this->isPropertyAvailable("SchedulingGroupId")) {
            return null;
        }
        return $this->getProperty("SchedulingGroupId");
    }
    /**
     * ID for the scheduling group that the open shift belongs to.
     * @var string
     */
    public function setSchedulingGroupId($value)
    {
        $this->setProperty("SchedulingGroupId", $value, true);
    }
}