<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 * Represents request to claim an [openShift](../resources/openshift.md) in a [schedule](../resources/schedule.md).
 */
class OpenShiftChangeRequest extends Entity
{
    /**
     *  ID for the open shift.
     * @return string
     */
    public function getOpenShiftId()
    {
        if (!$this->isPropertyAvailable("OpenShiftId")) {
            return null;
        }
        return $this->getProperty("OpenShiftId");
    }
    /**
     *  ID for the open shift.
     * @var string
     */
    public function setOpenShiftId($value)
    {
        $this->setProperty("OpenShiftId", $value, true);
    }
}