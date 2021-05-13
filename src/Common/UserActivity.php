<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Common;


use Office365\Entity;

class UserActivity extends Entity
{
    /**
     * @return string
     */
    public function getActivitySourceHost()
    {
        if (!$this->isPropertyAvailable("ActivitySourceHost")) {
            return null;
        }
        return $this->getProperty("ActivitySourceHost");
    }
    /**
     * @var string
     */
    public function setActivitySourceHost($value)
    {
        $this->setProperty("ActivitySourceHost", $value, true);
    }
    /**
     * @return string
     */
    public function getActivationUrl()
    {
        if (!$this->isPropertyAvailable("ActivationUrl")) {
            return null;
        }
        return $this->getProperty("ActivationUrl");
    }
    /**
     * @var string
     */
    public function setActivationUrl($value)
    {
        $this->setProperty("ActivationUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getAppActivityId()
    {
        if (!$this->isPropertyAvailable("AppActivityId")) {
            return null;
        }
        return $this->getProperty("AppActivityId");
    }
    /**
     * @var string
     */
    public function setAppActivityId($value)
    {
        $this->setProperty("AppActivityId", $value, true);
    }
    /**
     * @return string
     */
    public function getAppDisplayName()
    {
        if (!$this->isPropertyAvailable("AppDisplayName")) {
            return null;
        }
        return $this->getProperty("AppDisplayName");
    }
    /**
     * @var string
     */
    public function setAppDisplayName($value)
    {
        $this->setProperty("AppDisplayName", $value, true);
    }
    /**
     * @return string
     */
    public function getContentUrl()
    {
        if (!$this->isPropertyAvailable("ContentUrl")) {
            return null;
        }
        return $this->getProperty("ContentUrl");
    }
    /**
     * @var string
     */
    public function setContentUrl($value)
    {
        $this->setProperty("ContentUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getFallbackUrl()
    {
        if (!$this->isPropertyAvailable("FallbackUrl")) {
            return null;
        }
        return $this->getProperty("FallbackUrl");
    }
    /**
     * @var string
     */
    public function setFallbackUrl($value)
    {
        $this->setProperty("FallbackUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getUserTimezone()
    {
        if (!$this->isPropertyAvailable("UserTimezone")) {
            return null;
        }
        return $this->getProperty("UserTimezone");
    }
    /**
     * @var string
     */
    public function setUserTimezone($value)
    {
        $this->setProperty("UserTimezone", $value, true);
    }
    /**
     * @return Json
     */
    public function getContentInfo()
    {
        if (!$this->isPropertyAvailable("ContentInfo")) {
            return null;
        }
        return $this->getProperty("ContentInfo");
    }
    /**
     * @var Json
     */
    public function setContentInfo($value)
    {
        $this->setProperty("ContentInfo", $value, true);
    }
    /**
     * @return VisualInfo
     */
    public function getVisualElements()
    {
        if (!$this->isPropertyAvailable("VisualElements")) {
            return null;
        }
        return $this->getProperty("VisualElements");
    }
    /**
     * @var VisualInfo
     */
    public function setVisualElements($value)
    {
        $this->setProperty("VisualElements", $value, true);
    }
}