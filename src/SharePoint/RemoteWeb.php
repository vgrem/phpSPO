<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * Specifies 
 * a remote web that might be on a different domain.
 */
class RemoteWeb extends ClientObject
{
    /**
     * @return bool
     */
    public function getCanSendEmail()
    {
        if (!$this->isPropertyAvailable("CanSendEmail")) {
            return null;
        }
        return $this->getProperty("CanSendEmail");
    }
    /**
     * @var bool
     */
    public function setCanSendEmail($value)
    {
        $this->setProperty("CanSendEmail", $value, true);
    }
    /**
     * @return bool
     */
    public function getShareByEmailEnabled()
    {
        if (!$this->isPropertyAvailable("ShareByEmailEnabled")) {
            return null;
        }
        return $this->getProperty("ShareByEmailEnabled");
    }
    /**
     * @var bool
     */
    public function setShareByEmailEnabled($value)
    {
        $this->setProperty("ShareByEmailEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getShareByLinkEnabled()
    {
        if (!$this->isPropertyAvailable("ShareByLinkEnabled")) {
            return null;
        }
        return $this->getProperty("ShareByLinkEnabled");
    }
    /**
     * @var bool
     */
    public function setShareByLinkEnabled($value)
    {
        $this->setProperty("ShareByLinkEnabled", $value, true);
    }
    /**
     * @return Web
     */
    public function getWeb()
    {
        if (!$this->isPropertyAvailable("Web")) {
            $this->setProperty("Web", new Web($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "Web")));
        }
        return $this->getProperty("Web");
    }
}