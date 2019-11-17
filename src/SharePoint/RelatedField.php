<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * Represents 
 * a Lookup Field that points to a given list on a Web site.
 */
class RelatedField extends ClientObject
{
    /**
     * @return string
     */
    public function getFieldId()
    {
        if (!$this->isPropertyAvailable("FieldId")) {
            return null;
        }
        return $this->getProperty("FieldId");
    }
    /**
     * @var string
     */
    public function setFieldId($value)
    {
        $this->setProperty("FieldId", $value, true);
    }
    /**
     * @return string
     */
    public function getListId()
    {
        if (!$this->isPropertyAvailable("ListId")) {
            return null;
        }
        return $this->getProperty("ListId");
    }
    /**
     * @var string
     */
    public function setListId($value)
    {
        $this->setProperty("ListId", $value, true);
    }
    /**
     * @return integer
     */
    public function getRelationshipDeleteBehavior()
    {
        if (!$this->isPropertyAvailable("RelationshipDeleteBehavior")) {
            return null;
        }
        return $this->getProperty("RelationshipDeleteBehavior");
    }
    /**
     * @var integer
     */
    public function setRelationshipDeleteBehavior($value)
    {
        $this->setProperty("RelationshipDeleteBehavior", $value, true);
    }
    /**
     * @return string
     */
    public function getWebId()
    {
        if (!$this->isPropertyAvailable("WebId")) {
            return null;
        }
        return $this->getProperty("WebId");
    }
    /**
     * @var string
     */
    public function setWebId($value)
    {
        $this->setProperty("WebId", $value, true);
    }
}