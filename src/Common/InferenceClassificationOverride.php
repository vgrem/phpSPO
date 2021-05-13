<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Common;

use Office365\Entity;
use Office365\OutlookServices\EmailAddress;


class InferenceClassificationOverride extends Entity
{
    /**
     * @return EmailAddress
     */
    public function getSenderEmailAddress()
    {
        if (!$this->isPropertyAvailable("SenderEmailAddress")) {
            return null;
        }
        return $this->getProperty("SenderEmailAddress");
    }
    /**
     * @var EmailAddress
     */
    public function setSenderEmailAddress($value)
    {
        $this->setProperty("SenderEmailAddress", $value, true);
    }
}