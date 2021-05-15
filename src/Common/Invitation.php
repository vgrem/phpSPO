<?php

/**
 * Modified: 2020-05-24T21:54:31+00:00
 */
namespace Office365\Common;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class Invitation extends Entity
{
    /**
     * The display name of the user being invited.
     * @return string
     */
    public function getInvitedUserDisplayName()
    {
        return $this->getProperty("InvitedUserDisplayName");
    }
    /**
     * The display name of the user being invited.
     * @var string
     */
    public function setInvitedUserDisplayName($value)
    {
        $this->setProperty("InvitedUserDisplayName", $value, true);
    }
    /**
     * The userType of the user being invited. By default, this is Guest. You can invite as Member if you are a company administrator. 
     * @return string
     */
    public function getInvitedUserType()
    {
        return $this->getProperty("InvitedUserType");
    }
    /**
     * The userType of the user being invited. By default, this is Guest. You can invite as Member if you are a company administrator. 
     * @var string
     */
    public function setInvitedUserType($value)
    {
        $this->setProperty("InvitedUserType", $value, true);
    }
    /**
     * The email address of the user being invited. Required. The following special characters are not permitted in the email address:<br><ul><li>Tilde (~)</li><li>Exclamation point (`!`)</li><li>Number sign (`#`)</li><li>Dollar sign (`$`)</li><li>Percent (`%`)</li><li>Circumflex (`^`)</li><li>Ampersand (`&`)</li><li>Asterisk (`*`)</li><li>Parentheses (`( )`)</li><li>Plus sign (`+`)</li><li>Equal sign (`=`)</li><li>Brackets (`[ ]`)</li><li>Braces (`{ }`)</li><li>Backslash (`\`)</li><li>Slash mark (`/`)</li><li>Pipe (`\
     * @return string
     */
    public function getInvitedUserEmailAddress()
    {
        return $this->getProperty("InvitedUserEmailAddress");
    }
    /**
     * The email address of the user being invited. Required. The following special characters are not permitted in the email address:<br><ul><li>Tilde (~)</li><li>Exclamation point (`!`)</li><li>Number sign (`#`)</li><li>Dollar sign (`$`)</li><li>Percent (`%`)</li><li>Circumflex (`^`)</li><li>Ampersand (`&`)</li><li>Asterisk (`*`)</li><li>Parentheses (`( )`)</li><li>Plus sign (`+`)</li><li>Equal sign (`=`)</li><li>Brackets (`[ ]`)</li><li>Braces (`{ }`)</li><li>Backslash (`\`)</li><li>Slash mark (`/`)</li><li>Pipe (`\
     * @var string
     */
    public function setInvitedUserEmailAddress($value)
    {
        $this->setProperty("InvitedUserEmailAddress", $value, true);
    }
    /**
     * Indicates whether an email should be sent to the user being invited or not. The default is false.
     * @return bool
     */
    public function getSendInvitationMessage()
    {
        return $this->getProperty("SendInvitationMessage");
    }
    /**
     * Indicates whether an email should be sent to the user being invited or not. The default is false.
     * @var bool
     */
    public function setSendInvitationMessage($value)
    {
        $this->setProperty("SendInvitationMessage", $value, true);
    }
    /**
     * The URL user should be redirected to once the invitation is redeemed. Required.
     * @return string
     */
    public function getInviteRedirectUrl()
    {
        return $this->getProperty("InviteRedirectUrl");
    }
    /**
     * The URL user should be redirected to once the invitation is redeemed. Required.
     * @var string
     */
    public function setInviteRedirectUrl($value)
    {
        $this->setProperty("InviteRedirectUrl", $value, true);
    }
    /**
     * The URL user can use to redeem his invitation. Read-Only
     * @return string
     */
    public function getInviteRedeemUrl()
    {
        return $this->getProperty("InviteRedeemUrl");
    }
    /**
     * The URL user can use to redeem his invitation. Read-Only
     * @var string
     */
    public function setInviteRedeemUrl($value)
    {
        $this->setProperty("InviteRedeemUrl", $value, true);
    }
    /**
     * The status of the invitation. Possible values: PendingAcceptance, Completed, InProgress, and Error
     * @return string
     */
    public function getStatus()
    {
        return $this->getProperty("Status");
    }

    /**
     * The status of the invitation. Possible values: PendingAcceptance, Completed, InProgress, and Error
     *
     * @return self
     * @var string
     */
    public function setStatus($value)
    {
        return $this->setProperty("Status", $value, true);
    }
    /**
     * Additional configuration for the message being sent to the invited user, including customizing message text, language and cc recipient list.
     * @return InvitedUserMessageInfo
     */
    public function getInvitedUserMessageInfo()
    {
        return $this->getProperty("InvitedUserMessageInfo",new InvitedUserMessageInfo());
    }
    /**
     * Additional configuration for the message being sent to the invited user, including customizing message text, language and cc recipient list.
     * @var InvitedUserMessageInfo
     */
    public function setInvitedUserMessageInfo($value)
    {
        $this->setProperty("InvitedUserMessageInfo", $value, true);
    }
    /**
     * The user created as part of the invitation creation. Read-Only
     * @return User
     */
    public function getInvitedUser()
    {
        return $this->getProperty("InvitedUser",
            new User($this->getContext(), new ResourcePath("InvitedUser", $this->getResourcePath())));
    }
}