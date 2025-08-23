<?php

/**
 *  2025-08-22T05:43:25+00:00 
 */
namespace Office365\Outlook;

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
    /**
     * @return OpenShiftItem
     */
    public function getSharedOpenShift()
    {
        return $this->getProperty("SharedOpenShift");
    }
    /**
     * @var OpenShiftItem
     */
    public function setSharedOpenShift($value)
    {
        return $this->setProperty("SharedOpenShift", $value, true);
    }
    /**
     * @return OpenShiftItem
     */
    public function getDraftOpenShift()
    {
        return $this->getProperty("DraftOpenShift");
    }
    /**
     * @var OpenShiftItem
     */
    public function setDraftOpenShift($value)
    {
        return $this->setProperty("DraftOpenShift", $value, true);
    }
}