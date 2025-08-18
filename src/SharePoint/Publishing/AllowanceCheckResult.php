<?php

/**
 * Generated  2025-08-18T13:04:30+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
use Office365\SharePoint\BaseEntity;

class AllowanceCheckResult extends BaseEntity
{
    /**
     * @return bool
     */
    public function getAllowed()
    {
        return $this->getProperty("Allowed");
    }
    /**
     * @var bool
     */
    public function setAllowed($value)
    {
        return $this->setProperty("Allowed", $value, true);
    }
    /**
     * @return string
     */
    public function getErrorReason()
    {
        return $this->getProperty("ErrorReason");
    }
    /**
     * @var string
     */
    public function setErrorReason($value)
    {
        return $this->setProperty("ErrorReason", $value, true);
    }
    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->getProperty("ErrorCode");
    }
    /**
     * @var string
     */
    public function setErrorCode($value)
    {
        return $this->setProperty("ErrorCode", $value, true);
    }
}