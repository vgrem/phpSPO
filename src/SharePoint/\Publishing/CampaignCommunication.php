<?php

/**
 * Generated  2022-10-08T10:32:22+03:00 16.0.22921.12007
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class CampaignCommunication extends BaseEntity
{
    /**
     * @return string
     */
    public function getCommunicationMetadata()
    {
        return $this->getProperty("CommunicationMetadata");
    }
    /**
     * @var string
     */
    public function setCommunicationMetadata($value)
    {
        return $this->setProperty("CommunicationMetadata", $value, true);
    }
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