<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T18:22:48+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;

/**
 * Represents 
 * a collection of SPLanguage objects.<263>
 */
class LanguageCollection extends ClientObject
{
    /**
     * @return LanguageCollection
     */
    public function getItems()
    {
        if (!$this->isPropertyAvailable("Items")) {
            return null;
        }
        return $this->getProperty("Items");
    }
    /**
     * @var LanguageCollection
     */
    public function setItems($value)
    {
        $this->setProperty("Items", $value, true);
    }
}