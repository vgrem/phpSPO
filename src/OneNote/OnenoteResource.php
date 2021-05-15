<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneNote;

use Office365\Entity;

class OnenoteResource extends Entity
{
    /**
     * @return string
     */
    public function getContentUrl()
    {
        return $this->getProperty("ContentUrl");
    }
    /**
     * @var string
     */
    public function setContentUrl($value)
    {
        $this->setProperty("ContentUrl", $value, true);
    }
}