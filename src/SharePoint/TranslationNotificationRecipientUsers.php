<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T16:35:02+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePath;


class TranslationNotificationRecipientUsers extends ClientObject
{
    /**
     * @return string
     */
    public function getLanguageCode()
    {
        if (!$this->isPropertyAvailable("LanguageCode")) {
            return null;
        }
        return $this->getProperty("LanguageCode");
    }
    /**
     * @var string
     */
    public function setLanguageCode($value)
    {
        $this->setProperty("LanguageCode", $value, true);
    }
    /**
     * @return UserCollection
     */
    public function getRecipients()
    {
        if (!$this->isPropertyAvailable("Recipients")) {
            $this->setProperty("Recipients", new UserCollection($this->getContext(), new ResourcePath("Recipients", $this->getResourcePath())));
        }
        return $this->getProperty("Recipients");
    }
}