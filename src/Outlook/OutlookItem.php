<?php

/**
 * Modified: 2020-05-24T22:03:02+00:00 
 */
namespace Office365\Outlook;

use Office365\Entity;

class OutlookItem extends Entity
{
    /**
     * @return string
     */
    public function getChangeKey()
    {
        return $this->getProperty("ChangeKey", null);
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
        return $this->getProperty("Categories", null);
    }
    /**
     * @var array
     */
    public function setCategories($value)
    {
        $this->setProperty("Categories", $value, true);
    }
}