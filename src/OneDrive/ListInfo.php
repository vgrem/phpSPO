<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class ListInfo extends ClientValue
{
    /**
     * @var bool
     */
    public $ContentTypesEnabled;
    /**
     * @var bool
     */
    public $Hidden;
    /**
     * @var string
     */
    public $Template;
}