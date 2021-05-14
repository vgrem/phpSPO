<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Entity;

class ThumbnailSet extends Entity
{
    /**
     * @return Thumbnail
     */
    public function getLarge()
    {
        return $this->getProperty("Large", new Thumbnail());
    }
    /**
     * @var Thumbnail
     */
    public function setLarge($value)
    {
        $this->setProperty("Large", $value, true);
    }
    /**
     * @return Thumbnail
     */
    public function getMedium()
    {
        return $this->getProperty("Medium", new Thumbnail());
    }
    /**
     * @var Thumbnail
     */
    public function setMedium($value)
    {
        $this->setProperty("Medium", $value, true);
    }
    /**
     * @return Thumbnail
     */
    public function getSmall()
    {
        return $this->getProperty("Small", new Thumbnail());
    }
    /**
     * @var Thumbnail
     */
    public function setSmall($value)
    {
        $this->setProperty("Small", $value, true);
    }
    /**
     * @return Thumbnail
     */
    public function getSource()
    {
        return $this->getProperty("Source", new Thumbnail());
    }
    /**
     * @var Thumbnail
     */
    public function setSource($value)
    {
        $this->setProperty("Source", $value, true);
    }
}