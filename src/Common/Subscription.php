<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Entity;

/**
 *  "A subscription allows a client app to receive change notifications about changes to data in Microsoft Graph. Currently, subscriptions are enabled for the following resources
 */
class Subscription extends Entity
{
    /**
     * @return string
     */
    public function getResource()
    {
        if (!$this->isPropertyAvailable("Resource")) {
            return null;
        }
        return $this->getProperty("Resource");
    }
    /**
     * @var string
     */
    public function setResource($value)
    {
        $this->setProperty("Resource", $value, true);
    }
    /**
     * @return string
     */
    public function getChangeType()
    {
        if (!$this->isPropertyAvailable("ChangeType")) {
            return null;
        }
        return $this->getProperty("ChangeType");
    }
    /**
     * @var string
     */
    public function setChangeType($value)
    {
        $this->setProperty("ChangeType", $value, true);
    }
    /**
     * @return string
     */
    public function getClientState()
    {
        if (!$this->isPropertyAvailable("ClientState")) {
            return null;
        }
        return $this->getProperty("ClientState");
    }
    /**
     * @var string
     */
    public function setClientState($value)
    {
        $this->setProperty("ClientState", $value, true);
    }
    /**
     * @return string
     */
    public function getNotificationUrl()
    {
        if (!$this->isPropertyAvailable("NotificationUrl")) {
            return null;
        }
        return $this->getProperty("NotificationUrl");
    }
    /**
     * @var string
     */
    public function setNotificationUrl($value)
    {
        $this->setProperty("NotificationUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getApplicationId()
    {
        if (!$this->isPropertyAvailable("ApplicationId")) {
            return null;
        }
        return $this->getProperty("ApplicationId");
    }
    /**
     * @var string
     */
    public function setApplicationId($value)
    {
        $this->setProperty("ApplicationId", $value, true);
    }
    /**
     * @return string
     */
    public function getCreatorId()
    {
        if (!$this->isPropertyAvailable("CreatorId")) {
            return null;
        }
        return $this->getProperty("CreatorId");
    }
    /**
     * @var string
     */
    public function setCreatorId($value)
    {
        $this->setProperty("CreatorId", $value, true);
    }
    /**
     * @return string
     */
    public function getLatestSupportedTlsVersion()
    {
        if (!$this->isPropertyAvailable("LatestSupportedTlsVersion")) {
            return null;
        }
        return $this->getProperty("LatestSupportedTlsVersion");
    }
    /**
     * @var string
     */
    public function setLatestSupportedTlsVersion($value)
    {
        $this->setProperty("LatestSupportedTlsVersion", $value, true);
    }
}