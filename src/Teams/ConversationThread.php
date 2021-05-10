<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 *  "A conversationThread is a collection of posts."
 */
class ConversationThread extends Entity
{
    /**
     * The topic of the conversation. This property can be set when the conversation is created, but it cannot be updated.
     * @return string
     */
    public function getTopic()
    {
        if (!$this->isPropertyAvailable("Topic")) {
            return null;
        }
        return $this->getProperty("Topic");
    }
    /**
     * The topic of the conversation. This property can be set when the conversation is created, but it cannot be updated.
     * @var string
     */
    public function setTopic($value)
    {
        $this->setProperty("Topic", $value, true);
    }
    /**
     * Indicates whether any of the posts within this thread has at least one attachment.
     * @return bool
     */
    public function getHasAttachments()
    {
        if (!$this->isPropertyAvailable("HasAttachments")) {
            return null;
        }
        return $this->getProperty("HasAttachments");
    }
    /**
     * Indicates whether any of the posts within this thread has at least one attachment.
     * @var bool
     */
    public function setHasAttachments($value)
    {
        $this->setProperty("HasAttachments", $value, true);
    }
    /**
     * All the users that sent a message to this thread.
     * @return array
     */
    public function getUniqueSenders()
    {
        if (!$this->isPropertyAvailable("UniqueSenders")) {
            return null;
        }
        return $this->getProperty("UniqueSenders");
    }
    /**
     * All the users that sent a message to this thread.
     * @var array
     */
    public function setUniqueSenders($value)
    {
        $this->setProperty("UniqueSenders", $value, true);
    }
    /**
     * A short summary from the body of the latest post in this converstaion.
     * @return string
     */
    public function getPreview()
    {
        if (!$this->isPropertyAvailable("Preview")) {
            return null;
        }
        return $this->getProperty("Preview");
    }
    /**
     * A short summary from the body of the latest post in this converstaion.
     * @var string
     */
    public function setPreview($value)
    {
        $this->setProperty("Preview", $value, true);
    }
    /**
     * Indicates if the thread is locked.
     * @return bool
     */
    public function getIsLocked()
    {
        if (!$this->isPropertyAvailable("IsLocked")) {
            return null;
        }
        return $this->getProperty("IsLocked");
    }
    /**
     * Indicates if the thread is locked.
     * @var bool
     */
    public function setIsLocked($value)
    {
        $this->setProperty("IsLocked", $value, true);
    }
}