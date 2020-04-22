<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:39:07+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Directory\Provider;

use Office365\Runtime\ClientValueObject;

class PropertyChange extends ClientValueObject
{
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $Value;
    /**
     * @var array
     */
    public $Values;
}