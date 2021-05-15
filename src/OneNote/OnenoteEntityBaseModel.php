<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneNote;

use Office365\Entity;

class OnenoteEntityBaseModel extends Entity
{
    /**
     * @return string
     */
    public function getSelf()
    {
        if (!$this->isPropertyAvailable("Self")) {
            return null;
        }
        return $this->getProperty("Self");
    }
    /**
     * @var string
     */
    public function setSelf($value)
    {
        $this->setProperty("Self", $value, true);
    }
}