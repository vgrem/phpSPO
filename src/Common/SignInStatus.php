<?php

/**
 * Modified: 2020-05-24T21:39:44+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class SignInStatus extends ClientValue
{
    /**
     * @var integer
     */
    public $ErrorCode;
    /**
     * @var string
     */
    public $FailureReason;
    /**
     * @var string
     */
    public $AdditionalDetails;
}