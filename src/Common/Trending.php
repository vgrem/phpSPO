<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Common;

use Office365\Entity;
use Office365\OneDrive\ResourceReference;
use Office365\OneDrive\ResourceVisualization;
use Office365\Runtime\ResourcePath;
class Trending extends Entity
{
    /**
     * @return double
     */
    public function getWeight()
    {
        if (!$this->isPropertyAvailable("Weight")) {
            return null;
        }
        return $this->getProperty("Weight");
    }
    /**
     * @var double
     */
    public function setWeight($value)
    {
        $this->setProperty("Weight", $value, true);
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