<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 * A collection of [schedulingGroup](schedulinggroup.md) objects, [shift](shift.md) objects, [timeOffReason](timeoffreason.md) objects, and [timeOff](timeoff.md) objects within a [team](../resources/team.md). 
 */
class Schedule extends Entity
{
    /**
     * @return bool
     */
    public function getEnabled()
    {
        if (!$this->isPropertyAvailable("Enabled")) {
            return null;
        }
        return $this->getProperty("Enabled");
    }
    /**
     * @var bool
     */
    public function setEnabled($value)
    {
        $this->setProperty("Enabled", $value, true);
    }
    /**
     * @return string
     */
    public function getTimeZone()
    {
        if (!$this->isPropertyAvailable("TimeZone")) {
            return null;
        }
        return $this->getProperty("TimeZone");
    }
    /**
     * @var string
     */
    public function setTimeZone($value)
    {
        $this->setProperty("TimeZone", $value, true);
    }
    /**
     * @return string
     */
    public function getProvisionStatusCode()
    {
        if (!$this->isPropertyAvailable("ProvisionStatusCode")) {
            return null;
        }
        return $this->getProperty("ProvisionStatusCode");
    }
    /**
     * @var string
     */
    public function setProvisionStatusCode($value)
    {
        $this->setProperty("ProvisionStatusCode", $value, true);
    }
    /**
     * @return array
     */
    public function getWorkforceIntegrationIds()
    {
        if (!$this->isPropertyAvailable("WorkforceIntegrationIds")) {
            return null;
        }
        return $this->getProperty("WorkforceIntegrationIds");
    }
    /**
     * @var array
     */
    public function setWorkforceIntegrationIds($value)
    {
        $this->setProperty("WorkforceIntegrationIds", $value, true);
    }
    /**
     * @return bool
     */
    public function getTimeClockEnabled()
    {
        if (!$this->isPropertyAvailable("TimeClockEnabled")) {
            return null;
        }
        return $this->getProperty("TimeClockEnabled");
    }
    /**
     * @var bool
     */
    public function setTimeClockEnabled($value)
    {
        $this->setProperty("TimeClockEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getOpenShiftsEnabled()
    {
        if (!$this->isPropertyAvailable("OpenShiftsEnabled")) {
            return null;
        }
        return $this->getProperty("OpenShiftsEnabled");
    }
    /**
     * @var bool
     */
    public function setOpenShiftsEnabled($value)
    {
        $this->setProperty("OpenShiftsEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getSwapShiftsRequestsEnabled()
    {
        if (!$this->isPropertyAvailable("SwapShiftsRequestsEnabled")) {
            return null;
        }
        return $this->getProperty("SwapShiftsRequestsEnabled");
    }
    /**
     * @var bool
     */
    public function setSwapShiftsRequestsEnabled($value)
    {
        $this->setProperty("SwapShiftsRequestsEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getOfferShiftRequestsEnabled()
    {
        if (!$this->isPropertyAvailable("OfferShiftRequestsEnabled")) {
            return null;
        }
        return $this->getProperty("OfferShiftRequestsEnabled");
    }
    /**
     * @var bool
     */
    public function setOfferShiftRequestsEnabled($value)
    {
        $this->setProperty("OfferShiftRequestsEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getTimeOffRequestsEnabled()
    {
        if (!$this->isPropertyAvailable("TimeOffRequestsEnabled")) {
            return null;
        }
        return $this->getProperty("TimeOffRequestsEnabled");
    }
    /**
     * @var bool
     */
    public function setTimeOffRequestsEnabled($value)
    {
        $this->setProperty("TimeOffRequestsEnabled", $value, true);
    }
}