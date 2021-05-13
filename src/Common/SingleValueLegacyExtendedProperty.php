<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 *  "An extended property that contains a single value. "
 */
class SingleValueLegacyExtendedProperty extends ClientObject
{
    /**
     * A property value.
     * @return string
     */
    public function getValue()
    {
        if (!$this->isPropertyAvailable("Value")) {
            return null;
        }
        return $this->getProperty("Value");
    }
    /**
     * A property value.
     * @var string
     */
    public function setValue($value)
    {
        $this->setProperty("Value", $value, true);
    }
}