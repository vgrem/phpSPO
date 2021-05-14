<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class NumberColumn extends ClientValue
{
    /**
     * @var string
     */
    public $DecimalPlaces;
    /**
     * @var string
     */
    public $DisplayAs;
    /**
     * @var double
     */
    public $Maximum;
    /**
     * @var double
     */
    public $Minimum;
}