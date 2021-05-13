<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Entity;
class TargetedManagedAppPolicyAssignment extends Entity
{
    /**
     * @return DeviceAndAppManagementAssignmentTarget
     */
    public function getTarget()
    {
        return $this->getProperty("Target", new DeviceAndAppManagementAssignmentTarget());
    }
    /**
     * @var DeviceAndAppManagementAssignmentTarget
     */
    public function setTarget($value)
    {
        $this->setProperty("Target", $value, true);
    }
}