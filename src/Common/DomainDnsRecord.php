<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class DomainDnsRecord extends ClientObject
{
    /**
     * @return bool
     */
    public function getIsOptional()
    {
        if (!$this->isPropertyAvailable("IsOptional")) {
            return null;
        }
        return $this->getProperty("IsOptional");
    }
    /**
     * @var bool
     */
    public function setIsOptional($value)
    {
        $this->setProperty("IsOptional", $value, true);
    }
    /**
     * @return string
     */
    public function getLabel()
    {
        if (!$this->isPropertyAvailable("Label")) {
            return null;
        }
        return $this->getProperty("Label");
    }
    /**
     * @var string
     */
    public function setLabel($value)
    {
        $this->setProperty("Label", $value, true);
    }
    /**
     * @return string
     */
    public function getRecordType()
    {
        if (!$this->isPropertyAvailable("RecordType")) {
            return null;
        }
        return $this->getProperty("RecordType");
    }
    /**
     * @var string
     */
    public function setRecordType($value)
    {
        $this->setProperty("RecordType", $value, true);
    }
    /**
     * @return string
     */
    public function getSupportedService()
    {
        if (!$this->isPropertyAvailable("SupportedService")) {
            return null;
        }
        return $this->getProperty("SupportedService");
    }
    /**
     * @var string
     */
    public function setSupportedService($value)
    {
        $this->setProperty("SupportedService", $value, true);
    }
    /**
     * @return integer
     */
    public function getTtl()
    {
        if (!$this->isPropertyAvailable("Ttl")) {
            return null;
        }
        return $this->getProperty("Ttl");
    }
    /**
     * @var integer
     */
    public function setTtl($value)
    {
        $this->setProperty("Ttl", $value, true);
    }
}