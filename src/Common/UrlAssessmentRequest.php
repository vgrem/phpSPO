<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 *  "Used to create and retrieve a URL threat assessment."
 */
class UrlAssessmentRequest extends ClientObject
{
    /**
     * The URL string.
     * @return string
     */
    public function getUrl()
    {
        if (!$this->isPropertyAvailable("Url")) {
            return null;
        }
        return $this->getProperty("Url");
    }
    /**
     * The URL string.
     * @var string
     */
    public function setUrl($value)
    {
        $this->setProperty("Url", $value, true);
    }
}