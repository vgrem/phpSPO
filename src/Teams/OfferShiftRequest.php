<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Teams;

use Office365\Entity;


/**
 * Represents a request to offer a shift to another user in the team.
 */
class OfferShiftRequest extends Entity
{
    /**
     *  Custom message sent by recipient of the offer shift request. 
     * @return string
     */
    public function getRecipientActionMessage()
    {
        if (!$this->isPropertyAvailable("RecipientActionMessage")) {
            return null;
        }
        return $this->getProperty("RecipientActionMessage");
    }
    /**
     *  Custom message sent by recipient of the offer shift request. 
     * @var string
     */
    public function setRecipientActionMessage($value)
    {
        $this->setProperty("RecipientActionMessage", $value, true);
    }
    /**
     *  User ID of the sender of the offer shift request.
     * @return string
     */
    public function getSenderShiftId()
    {
        if (!$this->isPropertyAvailable("SenderShiftId")) {
            return null;
        }
        return $this->getProperty("SenderShiftId");
    }
    /**
     *  User ID of the sender of the offer shift request.
     * @var string
     */
    public function setSenderShiftId($value)
    {
        $this->setProperty("SenderShiftId", $value, true);
    }
    /**
     *  User ID of the recipient of the offer shift request.
     * @return string
     */
    public function getRecipientUserId()
    {
        if (!$this->isPropertyAvailable("RecipientUserId")) {
            return null;
        }
        return $this->getProperty("RecipientUserId");
    }
    /**
     *  User ID of the recipient of the offer shift request.
     * @var string
     */
    public function setRecipientUserId($value)
    {
        $this->setProperty("RecipientUserId", $value, true);
    }
}