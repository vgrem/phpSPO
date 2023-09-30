<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientObject;
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
    /**
     * @return string
     */
    public function getVerifiedTopicAllowedEditors()
    {
        return $this->getProperty("VerifiedTopicAllowedEditors");
    }
    /**
     * @var string
     */
    public function setVerifiedTopicAllowedEditors($value)
    {
        return $this->setProperty("VerifiedTopicAllowedEditors", $value, true);
    }
}