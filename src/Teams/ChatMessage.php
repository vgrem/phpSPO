<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 * Represents an individual chat message within a [channel](./channel.md) or (in beta) [chat](/graph/api/resources/chat?view=graph-rest-beta). The chat message can be a root chat message or part of a reply thread that is defined by the **replyToId** property in the chat message.
 */
class ChatMessage extends Entity
{
    /**
     *  Read-only. Id of the parent chat message or root chat message of the thread. (Only applies to chat messages in channels not chats) 
     * @return string
     */
    public function getReplyToId()
    {
        if (!$this->isPropertyAvailable("ReplyToId")) {
            return null;
        }
        return $this->getProperty("ReplyToId");
    }
    /**
     *  Read-only. Id of the parent chat message or root chat message of the thread. (Only applies to chat messages in channels not chats) 
     * @var string
     */
    public function setReplyToId($value)
    {
        $this->setProperty("ReplyToId", $value, true);
    }
    /**
     *  Read-only. Version number of the chat message. 
     * @return string
     */
    public function getEtag()
    {
        if (!$this->isPropertyAvailable("Etag")) {
            return null;
        }
        return $this->getProperty("Etag");
    }
    /**
     *  Read-only. Version number of the chat message. 
     * @var string
     */
    public function setEtag($value)
    {
        $this->setProperty("Etag", $value, true);
    }
    /**
     *  The subject of the chat message, in plaintext.
     * @return string
     */
    public function getSubject()
    {
        if (!$this->isPropertyAvailable("Subject")) {
            return null;
        }
        return $this->getProperty("Subject");
    }
    /**
     *  The subject of the chat message, in plaintext.
     * @var string
     */
    public function setSubject($value)
    {
        $this->setProperty("Subject", $value, true);
    }
    /**
     *  Summary text of the chat message that could be used for push notifications and summary views or fall back views. Only applies to channel chat messages, not chat messages in a chat. 
     * @return string
     */
    public function getSummary()
    {
        if (!$this->isPropertyAvailable("Summary")) {
            return null;
        }
        return $this->getProperty("Summary");
    }
    /**
     *  Summary text of the chat message that could be used for push notifications and summary views or fall back views. Only applies to channel chat messages, not chat messages in a chat. 
     * @var string
     */
    public function setSummary($value)
    {
        $this->setProperty("Summary", $value, true);
    }
    /**
     * Locale of the chat message set by the client.
     * @return string
     */
    public function getLocale()
    {
        if (!$this->isPropertyAvailable("Locale")) {
            return null;
        }
        return $this->getProperty("Locale");
    }
    /**
     * Locale of the chat message set by the client.
     * @var string
     */
    public function setLocale($value)
    {
        $this->setProperty("Locale", $value, true);
    }
    /**
     * @return string
     */
    public function getWebUrl()
    {
        if (!$this->isPropertyAvailable("WebUrl")) {
            return null;
        }
        return $this->getProperty("WebUrl");
    }
    /**
     * @var string
     */
    public function setWebUrl($value)
    {
        $this->setProperty("WebUrl", $value, true);
    }
}