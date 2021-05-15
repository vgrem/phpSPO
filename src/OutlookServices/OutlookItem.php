<?php

/**
 * Modified: 2020-05-24T22:03:02+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

class OutlookItem extends Entity
{
    /**
     * @return string
     */
    public function getChangeKey()
    {
        if (!$this->isPropertyAvailable("ChangeKey")) {
            return null;
        }
        return $this->getProperty("ChangeKey");
    }
    /**
     * @var string
     */
    public function setChangeKey($value)
    {
        $this->setProperty("ChangeKey", $value, true);
    }
    /**
     * @return array
     */
    public function getCategories()
    {
        if (!$this->isPropertyAvailable("Categories")) {
            return null;
        }
        return $this->getProperty("Categories");
    }
    /**
     * @var array
     */
    public function setCategories($value)
    {
        $this->setProperty("Categories", $value, true);
    }
}