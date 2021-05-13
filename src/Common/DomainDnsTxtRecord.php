<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class DomainDnsTxtRecord extends ClientObject
{
    /**
     * @return string
     */
    public function getText()
    {
        if (!$this->isPropertyAvailable("Text")) {
            return null;
        }
        return $this->getProperty("Text");
    }
    /**
     * @var string
     */
    public function setText($value)
    {
        $this->setProperty("Text", $value, true);
    }
}