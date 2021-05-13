<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class Windows10EnterpriseModernAppManagementConfiguration extends ClientObject
{
    /**
     * @return bool
     */
    public function getUninstallBuiltInApps()
    {
        if (!$this->isPropertyAvailable("UninstallBuiltInApps")) {
            return null;
        }
        return $this->getProperty("UninstallBuiltInApps");
    }
    /**
     * @var bool
     */
    public function setUninstallBuiltInApps($value)
    {
        $this->setProperty("UninstallBuiltInApps", $value, true);
    }
}