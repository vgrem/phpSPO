<?php

/**
 * Modified: 2020-05-24T21:23:29+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class AppIdentity extends ClientValue
{
    /**
     * @var string
     */
    public $AppId;
    /**
     * @var string
     */
    public $DisplayName;
    /**
     * @var string
     */
    public $ServicePrincipalId;
    /**
     * @var string
     */
    public $ServicePrincipalName;
}