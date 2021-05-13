<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Common;

use Office365\Intune\ManagedAppPolicyDeploymentSummary;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;
class DefaultManagedAppProtection extends ClientObject
{
    /**
     * @return bool
     */
    public function getScreenCaptureBlocked()
    {
        if (!$this->isPropertyAvailable("ScreenCaptureBlocked")) {
            return null;
        }
        return $this->getProperty("ScreenCaptureBlocked");
    }
    /**
     * @var bool
     */
    public function setScreenCaptureBlocked($value)
    {
        $this->setProperty("ScreenCaptureBlocked", $value, true);
    }
    /**
     * @return bool
     */
    public function getEncryptAppData()
    {
        if (!$this->isPropertyAvailable("EncryptAppData")) {
            return null;
        }
        return $this->getProperty("EncryptAppData");
    }
    /**
     * @var bool
     */
    public function setEncryptAppData($value)
    {
        $this->setProperty("EncryptAppData", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisableAppEncryptionIfDeviceEncryptionIsEnabled()
    {
        if (!$this->isPropertyAvailable("DisableAppEncryptionIfDeviceEncryptionIsEnabled")) {
            return null;
        }
        return $this->getProperty("DisableAppEncryptionIfDeviceEncryptionIsEnabled");
    }
    /**
     * @var bool
     */
    public function setDisableAppEncryptionIfDeviceEncryptionIsEnabled($value)
    {
        $this->setProperty("DisableAppEncryptionIfDeviceEncryptionIsEnabled", $value, true);
    }
    /**
     * @return string
     */
    public function getMinimumRequiredSdkVersion()
    {
        if (!$this->isPropertyAvailable("MinimumRequiredSdkVersion")) {
            return null;
        }
        return $this->getProperty("MinimumRequiredSdkVersion");
    }
    /**
     * @var string
     */
    public function setMinimumRequiredSdkVersion($value)
    {
        $this->setProperty("MinimumRequiredSdkVersion", $value, true);
    }
    /**
     * @return integer
     */
    public function getDeployedAppCount()
    {
        if (!$this->isPropertyAvailable("DeployedAppCount")) {
            return null;
        }
        return $this->getProperty("DeployedAppCount");
    }
    /**
     * @var integer
     */
    public function setDeployedAppCount($value)
    {
        $this->setProperty("DeployedAppCount", $value, true);
    }
    /**
     * @return string
     */
    public function getMinimumRequiredPatchVersion()
    {
        if (!$this->isPropertyAvailable("MinimumRequiredPatchVersion")) {
            return null;
        }
        return $this->getProperty("MinimumRequiredPatchVersion");
    }
    /**
     * @var string
     */
    public function setMinimumRequiredPatchVersion($value)
    {
        $this->setProperty("MinimumRequiredPatchVersion", $value, true);
    }
    /**
     * @return string
     */
    public function getMinimumWarningPatchVersion()
    {
        if (!$this->isPropertyAvailable("MinimumWarningPatchVersion")) {
            return null;
        }
        return $this->getProperty("MinimumWarningPatchVersion");
    }
    /**
     * @var string
     */
    public function setMinimumWarningPatchVersion($value)
    {
        $this->setProperty("MinimumWarningPatchVersion", $value, true);
    }
    /**
     * @return bool
     */
    public function getFaceIdBlocked()
    {
        if (!$this->isPropertyAvailable("FaceIdBlocked")) {
            return null;
        }
        return $this->getProperty("FaceIdBlocked");
    }
    /**
     * @var bool
     */
    public function setFaceIdBlocked($value)
    {
        $this->setProperty("FaceIdBlocked", $value, true);
    }
    /**
     * @return ManagedAppPolicyDeploymentSummary
     */
    public function getDeploymentSummary()
    {
        if (!$this->isPropertyAvailable("DeploymentSummary")) {
            $this->setProperty("DeploymentSummary", new ManagedAppPolicyDeploymentSummary($this->getContext(), new ResourcePath("DeploymentSummary", $this->getResourcePath())));
        }
        return $this->getProperty("DeploymentSummary");
    }
}