<?php

/**
 *  2025-08-21T20:35:45+00:00 
 */
namespace Office365\Outlook\Events;

use Office365\Entity;
use Office365\Teams\TimeSlot;

class EventMessageResponse extends Entity
{
    /**
     * @return TimeSlot
     */
    public function getProposedNewTime()
    {
        return $this->getProperty("ProposedNewTime");
    }
    /**
     * @var TimeSlot
     */
    public function setProposedNewTime($value)
    {
        return $this->setProperty("ProposedNewTime", $value, true);
    }
}