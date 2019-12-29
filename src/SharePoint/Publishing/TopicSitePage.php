<?php

/**
 * Updated By PHP Office365 Generator 2019-12-21T23:09:34+00:00 16.0.19520.12047
 */
namespace Office365\PHP\Client\SharePoint\Publishing;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;

class TopicSitePage extends ClientObject
{
    /**
     * @return string
     */
    public function getEntityId()
    {
        if (!$this->isPropertyAvailable("EntityId")) {
            return null;
        }
        return $this->getProperty("EntityId");
    }
    /**
     * @var string
     */
    public function setEntityId($value)
    {
        $this->setProperty("EntityId", $value, true);
    }
    /**
     * @return string
     */
    public function getEntityRelations()
    {
        if (!$this->isPropertyAvailable("EntityRelations")) {
            return null;
        }
        return $this->getProperty("EntityRelations");
    }
    /**
     * @var string
     */
    public function setEntityRelations($value)
    {
        $this->setProperty("EntityRelations", $value, true);
    }
    /**
     * @return string
     */
    public function getEntityType()
    {
        if (!$this->isPropertyAvailable("EntityType")) {
            return null;
        }
        return $this->getProperty("EntityType");
    }
    /**
     * @var string
     */
    public function setEntityType($value)
    {
        $this->setProperty("EntityType", $value, true);
    }
}