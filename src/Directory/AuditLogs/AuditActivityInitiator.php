<?php

/**
 * Modified: 2020-05-24T21:28:29+00:00 
 */
namespace Office365\Directory\AuditLogs;

use Office365\Directory\Users\UserIdentity;
use Office365\Runtime\ClientValue;
class AuditActivityInitiator extends ClientValue
{
    /**
     * @var UserIdentity
     */
    public $User;
    /**
     * @var AppIdentity
     */
    public $App;
}