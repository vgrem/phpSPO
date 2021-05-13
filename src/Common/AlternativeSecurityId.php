<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class AlternativeSecurityId extends ClientValue
{
    /**
     * @var integer
     */
    public $Type;
    /**
     * @var string
     */
    public $IdentityProvider;
    /**
     * @var string
     */
    public $Key;
}