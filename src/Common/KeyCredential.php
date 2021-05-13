<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class KeyCredential extends ClientValue
{
    /**
     * @var string
     */
    public $CustomKeyIdentifier;
    /**
     * @var string
     */
    public $DisplayName;
    /**
     * @var string
     */
    public $KeyId;
    /**
     * @var string
     */
    public $Type;
    /**
     * @var string
     */
    public $Usage;
    /**
     * @var string
     */
    public $Key;
}