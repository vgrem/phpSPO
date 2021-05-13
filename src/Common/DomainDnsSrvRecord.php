<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class DomainDnsSrvRecord extends ClientObject
{
    /**
     * @return string
     */
    public function getNameTarget()
    {
        if (!$this->isPropertyAvailable("NameTarget")) {
            return null;
        }
        return $this->getProperty("NameTarget");
    }
    /**
     * @var string
     */
    public function setNameTarget($value)
    {
        $this->setProperty("NameTarget", $value, true);
    }
    /**
     * @return integer
     */
    public function getPort()
    {
        if (!$this->isPropertyAvailable("Port")) {
            return null;
        }
        return $this->getProperty("Port");
    }
    /**
     * @var integer
     */
    public function setPort($value)
    {
        $this->setProperty("Port", $value, true);
    }
    /**
     * @return integer
     */
    public function getPriority()
    {
        if (!$this->isPropertyAvailable("Priority")) {
            return null;
        }
        return $this->getProperty("Priority");
    }
    /**
     * @var integer
     */
    public function setPriority($value)
    {
        $this->setProperty("Priority", $value, true);
    }
    /**
     * @return string
     */
    public function getProtocol()
    {
        if (!$this->isPropertyAvailable("Protocol")) {
            return null;
        }
        return $this->getProperty("Protocol");
    }
    /**
     * @var string
     */
    public function setProtocol($value)
    {
        $this->setProperty("Protocol", $value, true);
    }
    /**
     * @return string
     */
    public function getService()
    {
        if (!$this->isPropertyAvailable("Service")) {
            return null;
        }
        return $this->getProperty("Service");
    }
    /**
     * @var string
     */
    public function setService($value)
    {
        $this->setProperty("Service", $value, true);
    }
    /**
     * @return integer
     */
    public function getWeight()
    {
        if (!$this->isPropertyAvailable("Weight")) {
            return null;
        }
        return $this->getProperty("Weight");
    }
    /**
     * @var integer
     */
    public function setWeight($value)
    {
        $this->setProperty("Weight", $value, true);
    }
}