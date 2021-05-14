<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\IdentitySet;
use Office365\Runtime\ClientValue;
class SharingInvitation extends ClientValue
{
    /**
     * @var string
     */
    public $Email;
    /**
     * @var IdentitySet
     */
    public $InvitedBy;
    /**
     * @var string
     */
    public $RedeemedBy;
    /**
     * @var bool
     */
    public $SignInRequired;
}