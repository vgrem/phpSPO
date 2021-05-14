<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class SiteCollection extends ClientValue
{
    /**
     * @var string
     */
    public $Hostname;
    /**
     * @var Root
     */
    public $Root;
    /**
     * @var string
     */
    public $DataLocationCode;
}