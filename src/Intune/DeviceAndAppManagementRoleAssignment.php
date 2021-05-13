<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;


use Office365\Entity;

class DeviceAndAppManagementRoleAssignment extends Entity
{
    /**
     * @return array
     */
    public function getMembers()
    {
        if (!$this->isPropertyAvailable("Members")) {
            return null;
        }
        return $this->getProperty("Members");
    }
    /**
     * @var array
     */
    public function setMembers($value)
    {
        $this->setProperty("Members", $value, true);
    }
}