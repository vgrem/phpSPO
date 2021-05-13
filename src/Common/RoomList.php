<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 *  "Represents a group of rooms created by the company."
 */
class RoomList extends ClientObject
{
    /**
     * @return string
     */
    public function getEmailAddress()
    {
        if (!$this->isPropertyAvailable("EmailAddress")) {
            return null;
        }
        return $this->getProperty("EmailAddress");
    }
    /**
     * @var string
     */
    public function setEmailAddress($value)
    {
        $this->setProperty("EmailAddress", $value, true);
    }
}