<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T16:35:02+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;

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
            $this->setProperty("Recipients", new UserCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "Recipients")));
        }
        return $this->getProperty("Recipients");
    }
}