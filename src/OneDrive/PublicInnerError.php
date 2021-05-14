<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class PublicInnerError extends ClientValue
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
}