<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Common;

use Office365\Intune\DeviceAndAppManagementAssignmentTarget;
use Office365\Runtime\ClientObject;

class EnrollmentConfigurationAssignment extends ClientObject
{
    /**
     * @return DeviceAndAppManagementAssignmentTarget
     */
    public function getTarget()
    {
        if (!$this->isPropertyAvailable("Target")) {
            return null;
        }
        return $this->getProperty("Target");
    }
    /**
     * @var DeviceAndAppManagementAssignmentTarget
     */
    public function setTarget($value)
    {
        $this->setProperty("Target", $value, true);
    }
}