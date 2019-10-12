<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:34:55+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Directory\Provider;

use Office365\PHP\Client\Runtime\ClientValueObject;

class LinkChange extends ClientValueObject
{
    /**
     * @var array
     */
    public $Added;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var array
     */
    public $Removed;
}