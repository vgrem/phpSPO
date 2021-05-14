<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;

class WorkbookTableSort extends Entity
{
    /**
     * @return bool
     */
    public function getMatchCase()
    {
        if (!$this->isPropertyAvailable("MatchCase")) {
            return null;
        }
        return $this->getProperty("MatchCase");
    }
    /**
     * @var bool
     */
    public function setMatchCase($value)
    {
        $this->setProperty("MatchCase", $value, true);
    }
    /**
     * @return string
     */
    public function getMethod()
    {
        if (!$this->isPropertyAvailable("Method")) {
            return null;
        }
        return $this->getProperty("Method");
    }
    /**
     * @var string
     */
    public function setMethod($value)
    {
        $this->setProperty("Method", $value, true);
    }
}