<?php

/**
 * Modified: 2019-11-17T18:33:00+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;

class AddressBarLinkSettings extends ClientValue
{
    /**
     * @var bool
     */
    public $linkDisabled;
    /**
     * @var integer
     */
    public $linkPermission;
}