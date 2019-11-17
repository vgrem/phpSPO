<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;

class SPMigrationJobStatus extends ClientObject
{
    /**
     * @return string
     */
    public function getJobId()
    {
        if (!$this->isPropertyAvailable("JobId")) {
            return null;
        }
        return $this->getProperty("JobId");
    }
    /**
     * @var string
     */
    public function setJobId($value)
    {
        $this->setProperty("JobId", $value, true);
    }
    /**
     * @return integer
     */
    public function getJobState()
    {
        if (!$this->isPropertyAvailable("JobState")) {
            return null;
        }
        return $this->getProperty("JobState");
    }
    /**
     * @var integer
     */
    public function setJobState($value)
    {
        $this->setProperty("JobState", $value, true);
    }
}