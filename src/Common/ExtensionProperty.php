<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;
class ExtensionProperty extends ClientObject
{
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
    public function getName()
    {
        if (!$this->isPropertyAvailable("Name")) {
            return null;
        }
        return $this->getProperty("Name");
    }
    /**
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * @return string
     */
    public function getDataType()
    {
        if (!$this->isPropertyAvailable("DataType")) {
            return null;
        }
        return $this->getProperty("DataType");
    }
    /**
     * @var string
     */
    public function setDataType($value)
    {
        $this->setProperty("DataType", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsSyncedFromOnPremises()
    {
        if (!$this->isPropertyAvailable("IsSyncedFromOnPremises")) {
            return null;
        }
        return $this->getProperty("IsSyncedFromOnPremises");
    }
    /**
     * @var bool
     */
    public function setIsSyncedFromOnPremises($value)
    {
        $this->setProperty("IsSyncedFromOnPremises", $value, true);
    }
    /**
     * @return array
     */
    public function getTargetObjects()
    {
        if (!$this->isPropertyAvailable("TargetObjects")) {
            return null;
        }
        return $this->getProperty("TargetObjects");
    }
    /**
     * @var array
     */
    public function setTargetObjects($value)
    {
        $this->setProperty("TargetObjects", $value, true);
    }
}