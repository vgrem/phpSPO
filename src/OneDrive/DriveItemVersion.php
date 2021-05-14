<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OneDrive;


class DriveItemVersion extends BaseItemVersion
{
    /**
     * @return integer
     */
    public function getSize()
    {
        if (!$this->isPropertyAvailable("Size")) {
            return null;
        }
        return $this->getProperty("Size");
    }
    /**
     * @var integer
     */
    public function setSize($value)
    {
        $this->setProperty("Size", $value, true);
    }
}