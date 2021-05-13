<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Common;

use Office365\Entity;


class ThreatAssessmentResult extends Entity
{
    /**
     * @return string
     */
    public function getMessage()
    {
        if (!$this->isPropertyAvailable("Message")) {
            return null;
        }
        return $this->getProperty("Message");
    }
    /**
     * @var string
     */
    public function setMessage($value)
    {
        $this->setProperty("Message", $value, true);
    }
}