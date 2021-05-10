<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;


use Office365\Entity;

/**
 *  "A channel is a collection of messages within a team. "
 */
class Channel extends Entity
{
    /**
     * Channel name as it will appear to the user in Microsoft Teams.
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }
    /**
     * Channel name as it will appear to the user in Microsoft Teams.
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * Optional textual description for the channel.
     * @return string
     */
    public function getDescription()
    {
        return $this->getProperty("Description");
    }
    /**
     * Optional textual description for the channel.
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     *  The email address for sending messages to the channel. Read-only.
     * @return string
     */
    public function getEmail()
    {
        return $this->getProperty("Email");
    }
    /**
     *  The email address for sending messages to the channel. Read-only.
     * @var string
     */
    public function setEmail($value)
    {
        $this->setProperty("Email", $value, true);
    }
    /**
     * A hyperlink that will navigate to the channel in Microsoft Teams. This is the URL that you get when you right-click a channel in Microsoft Teams and select Get link to channel. This URL should be treated as an opaque blob, and not parsed. Read-only.
     * @return string
     */
    public function getWebUrl()
    {
        return $this->getProperty("WebUrl");
    }
    /**
     * A hyperlink that will navigate to the channel in Microsoft Teams. This is the URL that you get when you right-click a channel in Microsoft Teams and select Get link to channel. This URL should be treated as an opaque blob, and not parsed. Read-only.
     * @var string
     */
    public function setWebUrl($value)
    {
        $this->setProperty("WebUrl", $value, true);
    }
}