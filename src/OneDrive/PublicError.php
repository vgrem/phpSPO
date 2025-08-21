<?php

/**
 *  2025-08-21T20:35:45+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class PublicError extends ClientValue
{
    /**
     * @var string
     */
    public $Code;
    /**
     * @var string
     */
    public $Message;
    /**
     * @var string
     */
    public $Target;
    /**
     * @var PublicInnerError
     */
    public $InnerError;
}