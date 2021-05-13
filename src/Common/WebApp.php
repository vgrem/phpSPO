<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;


use Office365\Entity;

class WebApp extends Entity
{
    /**
     * @return string
     */
    public function getAppUrl()
    {
        return $this->getProperty("AppUrl");
    }
    /**
     * @var string
     */
    public function setAppUrl($value)
    {
        $this->setProperty("AppUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getUseManagedBrowser()
    {
        return $this->getProperty("UseManagedBrowser");
    }
    /**
     * @var bool
     */
    public function setUseManagedBrowser($value)
    {
        $this->setProperty("UseManagedBrowser", $value, true);
    }
}