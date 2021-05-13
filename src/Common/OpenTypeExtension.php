<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Common;

use Office365\Entity;


/**
 *  "Open extensions (formerly known as Office 365 data extensions) provide an easy way to directly add untyped properties to a resource in Microsoft Graph."
 */
class OpenTypeExtension extends Entity
{
    /**
     * A unique text identifier for an open type open extension. Required.
     * @return string
     */
    public function getExtensionName()
    {
        if (!$this->isPropertyAvailable("ExtensionName")) {
            return null;
        }
        return $this->getProperty("ExtensionName");
    }
    /**
     * A unique text identifier for an open type open extension. Required.
     * @var string
     */
    public function setExtensionName($value)
    {
        $this->setProperty("ExtensionName", $value, true);
    }
}