<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class ApiApplication extends ClientValue
{
    /**
     * @var bool
     */
    public $AcceptMappedClaims;
    /**
     * @var array
     */
    public $KnownClientApplications;
    /**
     * @var integer
     */
    public $RequestedAccessTokenVersion;
}