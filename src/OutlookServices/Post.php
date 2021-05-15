<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
/**
 *  "Represents an individual Post item within a conversationThread entity."
 */
class Post extends Entity
{
    /**
     * Indicates whether the post has at least one attachment. This is a default property.
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
     * Indicates whether the post has at least one attachment. This is a default property.
     * @var bool
     */
    public function setHasAttachments($value)
    {
        $this->setProperty("HasAttachments", $value, true);
    }
    /**
     * Used in delegate access scenarios. Indicates who posted the message on behalf of another user. This is a default property.
     * @return Recipient
     */
    public function getFrom()
    {
        if (!$this->isPropertyAvailable("From")) {
            return null;
        }
        return $this->getProperty("From");
    }
    /**
     * Used in delegate access scenarios. Indicates who posted the message on behalf of another user. This is a default property.
     * @var Recipient
     */
    public function setFrom($value)
    {
        $this->setProperty("From", $value, true);
    }
    /**
     * Contains the address of the sender. The value of Sender is assumed to be the address of the authenticated user in the case when Sender is not specified. This is a default property.
     * @return Recipient
     */
    public function getSender()
    {
        if (!$this->isPropertyAvailable("Sender")) {
            return null;
        }
        return $this->getProperty("Sender");
    }
    /**
     * Contains the address of the sender. The value of Sender is assumed to be the address of the authenticated user in the case when Sender is not specified. This is a default property.
     * @var Recipient
     */
    public function setSender($value)
    {
        $this->setProperty("Sender", $value, true);
    }
    /**
     * Unique ID of the conversation thread. Read-only.
     * @return string
     */
    public function getConversationThreadId()
    {
        if (!$this->isPropertyAvailable("ConversationThreadId")) {
            return null;
        }
        return $this->getProperty("ConversationThreadId");
    }
    /**
     * Unique ID of the conversation thread. Read-only.
     * @var string
     */
    public function setConversationThreadId($value)
    {
        $this->setProperty("ConversationThreadId", $value, true);
    }
    /**
     * Unique ID of the conversation. Read-only.
     * @return string
     */
    public function getConversationId()
    {
        if (!$this->isPropertyAvailable("ConversationId")) {
            return null;
        }
        return $this->getProperty("ConversationId");
    }
    /**
     * Unique ID of the conversation. Read-only.
     * @var string
     */
    public function setConversationId($value)
    {
        $this->setProperty("ConversationId", $value, true);
    }
    /**
     * The contents of the post. This is a default property. This property can be null.
     * @return ItemBody
     */
    public function getBody()
    {
        if (!$this->isPropertyAvailable("Body")) {
            return null;
        }
        return $this->getProperty("Body");
    }
    /**
     * The contents of the post. This is a default property. This property can be null.
     * @var ItemBody
     */
    public function setBody($value)
    {
        $this->setProperty("Body", $value, true);
    }
    /**
     *  Read-only.
     * @return Post
     */
    public function getInReplyTo()
    {
        if (!$this->isPropertyAvailable("InReplyTo")) {
            $this->setProperty("InReplyTo", new Post($this->getContext(), new ResourcePath("InReplyTo", $this->getResourcePath())));
        }
        return $this->getProperty("InReplyTo");
    }
}