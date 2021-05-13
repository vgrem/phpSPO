<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class SettingStateDeviceSummary extends ClientObject
{
    /**
     * @return string
     */
    public function getSettingName()
    {
        if (!$this->isPropertyAvailable("SettingName")) {
            return null;
        }
        return $this->getProperty("SettingName");
    }
    /**
     * @var string
     */
    public function setSettingName($value)
    {
        $this->setProperty("SettingName", $value, true);
    }
    /**
     * @return string
     */
    public function getInstancePath()
    {
        if (!$this->isPropertyAvailable("InstancePath")) {
            return null;
        }
        return $this->getProperty("InstancePath");
    }
    /**
     * @var string
     */
    public function setInstancePath($value)
    {
        $this->setProperty("InstancePath", $value, true);
    }
    /**
     * @return integer
     */
    public function getUnknownDeviceCount()
    {
        if (!$this->isPropertyAvailable("UnknownDeviceCount")) {
            return null;
        }
        return $this->getProperty("UnknownDeviceCount");
    }
    /**
     * @var integer
     */
    public function setUnknownDeviceCount($value)
    {
        $this->setProperty("UnknownDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getNotApplicableDeviceCount()
    {
        if (!$this->isPropertyAvailable("NotApplicableDeviceCount")) {
            return null;
        }
        return $this->getProperty("NotApplicableDeviceCount");
    }
    /**
     * @var integer
     */
    public function setNotApplicableDeviceCount($value)
    {
        $this->setProperty("NotApplicableDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getCompliantDeviceCount()
    {
        if (!$this->isPropertyAvailable("CompliantDeviceCount")) {
            return null;
        }
        return $this->getProperty("CompliantDeviceCount");
    }
    /**
     * @var integer
     */
    public function setCompliantDeviceCount($value)
    {
        $this->setProperty("CompliantDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getRemediatedDeviceCount()
    {
        if (!$this->isPropertyAvailable("RemediatedDeviceCount")) {
            return null;
        }
        return $this->getProperty("RemediatedDeviceCount");
    }
    /**
     * @var integer
     */
    public function setRemediatedDeviceCount($value)
    {
        $this->setProperty("RemediatedDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getNonCompliantDeviceCount()
    {
        if (!$this->isPropertyAvailable("NonCompliantDeviceCount")) {
            return null;
        }
        return $this->getProperty("NonCompliantDeviceCount");
    }
    /**
     * @var integer
     */
    public function setNonCompliantDeviceCount($value)
    {
        $this->setProperty("NonCompliantDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getErrorDeviceCount()
    {
        if (!$this->isPropertyAvailable("ErrorDeviceCount")) {
            return null;
        }
        return $this->getProperty("ErrorDeviceCount");
    }
    /**
     * @var integer
     */
    public function setErrorDeviceCount($value)
    {
        $this->setProperty("ErrorDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getConflictDeviceCount()
    {
        if (!$this->isPropertyAvailable("ConflictDeviceCount")) {
            return null;
        }
        return $this->getProperty("ConflictDeviceCount");
    }
    /**
     * @var integer
     */
    public function setConflictDeviceCount($value)
    {
        $this->setProperty("ConflictDeviceCount", $value, true);
    }
}