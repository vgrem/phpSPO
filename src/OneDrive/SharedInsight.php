<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\OneDrive;

use Office365\Entity;

use Office365\Runtime\ResourcePath;
class SharedInsight extends Entity
{
    /**
     * @return Entity
     */
    public function getLastSharedMethod()
    {
        if (!$this->isPropertyAvailable("LastSharedMethod")) {
            $this->setProperty("LastSharedMethod", new Entity($this->getContext(), new ResourcePath("LastSharedMethod", $this->getResourcePath())));
        }
        return $this->getProperty("LastSharedMethod");
    }
    /**
     * @return Entity
     */
    public function getResource()
    {
        if (!$this->isPropertyAvailable("Resource")) {
            $this->setProperty("Resource", new Entity($this->getContext(), new ResourcePath("Resource", $this->getResourcePath())));
        }
        return $this->getProperty("Resource");
    }
    /**
     * @return SharingDetail
     */
    public function getLastShared()
    {
        if (!$this->isPropertyAvailable("LastShared")) {
            return null;
        }
        return $this->getProperty("LastShared");
    }
    /**
     * @var SharingDetail
     */
    public function setLastShared($value)
    {
        $this->setProperty("LastShared", $value, true);
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