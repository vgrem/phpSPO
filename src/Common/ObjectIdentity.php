<?php

/**
 * Modified: 2020-05-29T07:14:53+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class ObjectIdentity extends ClientValue
{
    /**
     * @var string
     */
    public $SignInType;
    /**
     * @var string
     */
    public $Issuer;
    /**
     * @var string
     */
    public $IssuerAssignedId;
}