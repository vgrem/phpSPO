<?php

/**
 * Generated  2023-01-13T18:22:53+02:00 16.0.23207.12005
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class CampaignPublication extends BaseEntity
{
    /**
     * @return string
     */
    public function getEmailEndpoint()
    {
        return $this->getProperty("EmailEndpoint");
    }
    /**
     * @var string
     */
    public function setEmailEndpoint($value)
    {
        return $this->setProperty("EmailEndpoint", $value, true);
    }
    /**
     * @return string
     */
    public function getPublicationMetadata()
    {
        return $this->getProperty("PublicationMetadata");
    }
    /**
     * @var string
     */
    public function setPublicationMetadata($value)
    {
        return $this->setProperty("PublicationMetadata", $value, true);
    }
    /**
     * @return integer
     */
    public function getPublicationStatus()
    {
        return $this->getProperty("PublicationStatus");
    }
    /**
     * @var integer
     */
    public function setPublicationStatus($value)
    {
        return $this->setProperty("PublicationStatus", $value, true);
    }
    /**
     * @return string
     */
    public function getSharePointEndpoint()
    {
        return $this->getProperty("SharePointEndpoint");
    }
    /**
     * @var string
     */
    public function setSharePointEndpoint($value)
    {
        return $this->setProperty("SharePointEndpoint", $value, true);
    }
    /**
     * @return string
     */
    public function getYammerEndpoint()
    {
        return $this->getProperty("YammerEndpoint");
    }
    /**
     * @var string
     */
    public function setYammerEndpoint($value)
    {
        return $this->setProperty("YammerEndpoint", $value, true);
    }
}