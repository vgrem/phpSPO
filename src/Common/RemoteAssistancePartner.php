<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class RemoteAssistancePartner extends ClientObject
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return string
     */
    public function getOnboardingUrl()
    {
        if (!$this->isPropertyAvailable("OnboardingUrl")) {
            return null;
        }
        return $this->getProperty("OnboardingUrl");
    }
    /**
     * @var string
     */
    public function setOnboardingUrl($value)
    {
        $this->setProperty("OnboardingUrl", $value, true);
    }
}