<?php

/**
 * Updated By PHP Office365 Generator 2019-11-13T13:43:06+00:00 16.0.19430.12066
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * Enables 
 * auditing of how site collections, sites, lists, folders, and list items are 
 * accessed, changed, and used.
 */
class Audit extends ClientObject
{
    /**
     * Gets or 
     * sets a value indicating what kinds of events and actions are audited 
     * specifically for this object.
     * @return integer
     */
    public function getAuditFlags()
    {
        if (!$this->isPropertyAvailable("AuditFlags")) {
            return null;
        }
        return $this->getProperty("AuditFlags");
    }
    /**
     * Gets or 
     * sets a value indicating what kinds of events and actions are audited 
     * specifically for this object.
     * @var integer
     */
    public function setAuditFlags($value)
    {
        $this->setProperty("AuditFlags", $value, true);
    }
}