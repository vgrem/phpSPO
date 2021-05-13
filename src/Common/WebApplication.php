<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class WebApplication extends ClientValue
{
    /**
     * @var string
     */
    public $HomePageUrl;
    /**
     * @var array
     */
    public $RedirectUris;
    /**
     * @var string
     */
    public $LogoutUrl;
    /**
     * @var ImplicitGrantSettings
     */
    public $ImplicitGrantSettings;
}