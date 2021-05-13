<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 *  "An extended property that contains a collection of values."
 */
class MultiValueLegacyExtendedProperty extends ClientObject
{
    /**
     * A collection of property values.
     * @return array
     */
    public function getValue()
    {
        if (!$this->isPropertyAvailable("Value")) {
            return null;
        }
        return $this->getProperty("Value");
    }
    /**
     * A collection of property values.
     * @var array
     */
    public function setValue($value)
    {
        $this->setProperty("Value", $value, true);
    }
}