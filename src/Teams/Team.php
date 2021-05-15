<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;
use Office365\Runtime\Http\RequestOptions;


/**
 *  "A team in Microsoft Teams is a collection of channels. "
 */
class Team extends Entity
{
    /**
     *  A hyperlink that will go to the team in the Microsoft Teams client. This is the URL that you get when you right-click a team in the Microsoft Teams client and select **Get link to team**. This URL should be treated as an opaque blob, and not parsed. 
     * @return string
     */
    public function getWebUrl()
    {
        return $this->getProperty("WebUrl");
    }

    /**
     *  A hyperlink that will go to the team in the Microsoft Teams client. This is the URL that you get when you right-click a team in the Microsoft Teams client and select **Get link to team**. This URL should be treated as an opaque blob, and not parsed.
     *
     * @return self
     * @var string
     */
    public function setWebUrl($value)
    {
        return $this->setProperty("WebUrl", $value, true);
    }
    /**
     * Whether this team is in read-only mode. 
     * @return bool
     */
    public function getIsArchived()
    {
        return $this->getProperty("IsArchived");
    }

    /**
     * Whether this team is in read-only mode.
     *
     * @return self
     * @var bool
     */
    public function setIsArchived($value)
    {
        return $this->setProperty("IsArchived", $value, true);
    }
    /**
     * Settings to configure whether members can perform certain actions, for example, create channels and add bots, in the team.
     * @return TeamMemberSettings
     */
    public function getMemberSettings()
    {
        return $this->getProperty("MemberSettings", new TeamMemberSettings());
    }

    /**
     * Settings to configure whether members can perform certain actions, for example, create channels and add bots, in the team.
     *
     * @return self
     * @var TeamMemberSettings
     */
    public function setMemberSettings($value)
    {
        return $this->setProperty("MemberSettings", $value, true);
    }
    /**
     * Settings to configure whether guests can create, update, or delete channels in the team.
     * @return TeamGuestSettings
     */
    public function getGuestSettings()
    {
        return $this->getProperty("GuestSettings", new TeamGuestSettings());
    }

    /**
     * Settings to configure whether guests can create, update, or delete channels in the team.
     *
     * @return self
     * @var TeamGuestSettings
     */
    public function setGuestSettings($value)
    {
        return $this->setProperty("GuestSettings", $value, true);
    }
    /**
     * Settings to configure messaging and mentions in the team.
     * @return TeamMessagingSettings
     */
    public function getMessagingSettings()
    {
        return $this->getProperty("MessagingSettings", new TeamMessagingSettings());
    }

    /**
     * Settings to configure messaging and mentions in the team.
     *
     * @return self
     * @var TeamMessagingSettings
     */
    public function setMessagingSettings($value)
    {
        return $this->setProperty("MessagingSettings", $value, true);
    }
    /**
     * Settings to configure use of Giphy, memes, and stickers in the team.
     * @return TeamFunSettings
     */
    public function getFunSettings()
    {
        return $this->getProperty("FunSettings", new TeamFunSettings());
    }

    /**
     * Settings to configure use of Giphy, memes, and stickers in the team.
     *
     * @return self
     * @var TeamFunSettings
     */
    public function setFunSettings($value)
    {
        return $this->setProperty("FunSettings", $value, true);
    }

    /**
     * Deletes a Team
     * @return Team
     */
    public function deleteObject()
    {
        parent::deleteObject();
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function (RequestOptions $request){
            $request->Url = str_replace ( "teams" , "groups", $request->Url );
        });
        return $this;
    }

}