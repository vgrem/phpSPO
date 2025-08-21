<?php

/**
 *  2025-08-21T20:35:45+00:00 
 */
namespace Office365\Outlook\Events;

use Office365\Outlook\DateTimeTimeZone;
use Office365\Outlook\Location;
use Office365\Runtime\ClientObject;
class EventMessageRequest extends ClientObject
{
    /**
     * @return bool
     */
    public function getResponseRequested()
    {
        if (!$this->isPropertyAvailable("ResponseRequested")) {
            return null;
        }
        return $this->getProperty("ResponseRequested");
    }
    /**
     * @var bool
     */
    public function setResponseRequested($value)
    {
        $this->setProperty("ResponseRequested", $value, true);
    }
    /**
     * @return bool
     */
    public function getAllowNewTimeProposals()
    {
        if (!$this->isPropertyAvailable("AllowNewTimeProposals")) {
            return null;
        }
        return $this->getProperty("AllowNewTimeProposals");
    }
    /**
     * @var bool
     */
    public function setAllowNewTimeProposals($value)
    {
        $this->setProperty("AllowNewTimeProposals", $value, true);
    }
    /**
     * @return Location
     */
    public function getPreviousLocation()
    {
        return $this->getProperty("PreviousLocation");
    }
    /**
     * @var Location
     */
    public function setPreviousLocation($value)
    {
        return $this->setProperty("PreviousLocation", $value, true);
    }
    /**
     * @return DateTimeTimeZone
     */
    public function getPreviousStartDateTime()
    {
        return $this->getProperty("PreviousStartDateTime");
    }
    /**
     * @var DateTimeTimeZone
     */
    public function setPreviousStartDateTime($value)
    {
        return $this->setProperty("PreviousStartDateTime", $value, true);
    }
    /**
     * @return DateTimeTimeZone
     */
    public function getPreviousEndDateTime()
    {
        return $this->getProperty("PreviousEndDateTime");
    }
    /**
     * @var DateTimeTimeZone
     */
    public function setPreviousEndDateTime($value)
    {
        return $this->setProperty("PreviousEndDateTime", $value, true);
    }
}