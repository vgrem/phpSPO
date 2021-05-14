<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class PersonOrGroupColumn extends ClientValue
{
    /**
     * @var bool
     */
    public $AllowMultipleSelection;
    /**
     * @var string
     */
    public $ChooseFromType;
    /**
     * @var string
     */
    public $DisplayAs;
}