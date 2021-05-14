<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class CalculatedColumn extends ClientValue
{
    /**
     * @var string
     */
    public $Format;
    /**
     * @var string
     */
    public $Formula;
    /**
     * @var string
     */
    public $OutputType;
}