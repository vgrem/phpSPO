<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Common;

use Office365\Entity;
use Office365\OneDrive\ResourceReference;
use Office365\OneDrive\ResourceVisualization;
use Office365\Runtime\ResourcePath;
class UsedInsight extends Entity
{

    public function getResource()
    {
        if (!$this->isPropertyAvailable("Resource")) {
            $this->setProperty("Resource", new Entity($this->getContext(), new ResourcePath("Resource", $this->getResourcePath())));
        }
        return $this->getProperty("Resource");
    }
    /**
     * @return UsageDetails
     */
    public function getLastUsed()
    {
        if (!$this->isPropertyAvailable("LastUsed")) {
            return null;
        }
        return $this->getProperty("LastUsed");
    }
    /**
     * @var UsageDetails
     */
    public function setLastUsed($value)
    {
        $this->setProperty("LastUsed", $value, true);
    }
    /**
     * @return ResourceVisualization
     */
    public function getResourceVisualization()
    {
        if (!$this->isPropertyAvailable("ResourceVisualization")) {
            return null;
        }
        return $this->getProperty("ResourceVisualization");
    }
    /**
     * @var ResourceVisualization
     */
    public function setResourceVisualization($value)
    {
        $this->setProperty("ResourceVisualization", $value, true);
    }
    /**
     * @return ResourceReference
     */
    public function getResourceReference()
    {
        if (!$this->isPropertyAvailable("ResourceReference")) {
            return null;
        }
        return $this->getProperty("ResourceReference");
    }
    /**
     * @var ResourceReference
     */
    public function setResourceReference($value)
    {
        $this->setProperty("ResourceReference", $value, true);
    }
}