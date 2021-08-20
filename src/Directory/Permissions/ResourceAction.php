<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Directory\Permissions;

use Office365\Runtime\ClientValue;
class ResourceAction extends ClientValue
{
    /**
     * @var array
     */
    public $AllowedResourceActions;
    /**
     * @var array
     */
    public $NotAllowedResourceActions;
}