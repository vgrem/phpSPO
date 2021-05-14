<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class DateTimeColumn extends ClientValue
{
    /**
     * @var string
     */
    public $DisplayAs;
    /**
     * @var string
     */
    public $Format;
}