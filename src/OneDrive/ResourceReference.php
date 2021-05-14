<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class ResourceReference extends ClientValue
{
    /**
     * @var string
     */
    public $WebUrl;
    /**
     * @var string
     */
    public $Id;
    /**
     * @var string
     */
    public $Type;
}