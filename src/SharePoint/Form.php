<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T16:07:15+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;

/**
 * Specified 
 * in [MS-WSSTS] 
 * section 2.1.2.15.4.
 */
class Form extends ClientObject
{
    /**
     * @return string
     */
    public function getId()
    {
        if (!$this->isPropertyAvailable("Id")) {
            return null;
        }
        return $this->getProperty("Id");
    }
    /**
     * @var string
     */
    public function setId($value)
    {
        $this->setProperty("Id", $value, true);
    }
    /**
     * @return string
     */
    public function getServerRelativeUrl()
    {
        if (!$this->isPropertyAvailable("ServerRelativeUrl")) {
            return null;
        }
        return $this->getProperty("ServerRelativeUrl");
    }
    /**
     * @var string
     */
    public function setServerRelativeUrl($value)
    {
        $this->setProperty("ServerRelativeUrl", $value, true);
    }
    /**
     * @return integer
     */
    public function getFormType()
    {
        if (!$this->isPropertyAvailable("FormType")) {
            return null;
        }
        return $this->getProperty("FormType");
    }
    /**
     * @var integer
     */
    public function setFormType($value)
    {
        $this->setProperty("FormType", $value, true);
    }
}