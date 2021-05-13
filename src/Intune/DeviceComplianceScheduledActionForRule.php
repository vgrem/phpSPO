<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;
class DeviceComplianceScheduledActionForRule extends ClientObject
{
    /**
     * @return string
     */
    public function getRuleName()
    {
        if (!$this->isPropertyAvailable("RuleName")) {
            return null;
        }
        return $this->getProperty("RuleName");
    }
    /**
     * @var string
     */
    public function setRuleName($value)
    {
        $this->setProperty("RuleName", $value, true);
    }
}