<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 * Represents a lifecycle policy for an Office 365 group. A group lifecycle policy allows administrators to set an expiration period for groups. For example, after 180 days, a group expires. When a group reaches its expiration, owners of the group are required to renew their group within a time interval defined by the administrator. Once renewed, the group expiration is extended by the number of days defined in the policy. For example, the group's new expiration is 180 days after renewal. If the group is not renewed, it expires and is deleted. The group can be restored within a period of 30 days from deletion.
 */
class GroupLifecyclePolicy extends ClientObject
{
    /**
     *  Number of days before a group expires and needs to be renewed. Once renewed, the group expiration is extended by the number of days defined. 
     * @return integer
     */
    public function getGroupLifetimeInDays()
    {
        if (!$this->isPropertyAvailable("GroupLifetimeInDays")) {
            return null;
        }
        return $this->getProperty("GroupLifetimeInDays");
    }
    /**
     *  Number of days before a group expires and needs to be renewed. Once renewed, the group expiration is extended by the number of days defined. 
     * @var integer
     */
    public function setGroupLifetimeInDays($value)
    {
        $this->setProperty("GroupLifetimeInDays", $value, true);
    }
    /**
     *  The group type for which the expiration policy applies. Possible values are **All**, **Selected** or **None**. 
     * @return string
     */
    public function getManagedGroupTypes()
    {
        if (!$this->isPropertyAvailable("ManagedGroupTypes")) {
            return null;
        }
        return $this->getProperty("ManagedGroupTypes");
    }
    /**
     *  The group type for which the expiration policy applies. Possible values are **All**, **Selected** or **None**. 
     * @var string
     */
    public function setManagedGroupTypes($value)
    {
        $this->setProperty("ManagedGroupTypes", $value, true);
    }
    /**
     *  List of email address to send notifications for groups without owners. Multiple email address can be defined by separating email address with a semicolon. 
     * @return string
     */
    public function getAlternateNotificationEmails()
    {
        if (!$this->isPropertyAvailable("AlternateNotificationEmails")) {
            return null;
        }
        return $this->getProperty("AlternateNotificationEmails");
    }
    /**
     *  List of email address to send notifications for groups without owners. Multiple email address can be defined by separating email address with a semicolon. 
     * @var string
     */
    public function setAlternateNotificationEmails($value)
    {
        $this->setProperty("AlternateNotificationEmails", $value, true);
    }
}