<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class ItemReference extends ClientValue
{
    /**
     * @var string
     */
    public $DriveId;
    /**
     * @var string
     */
    public $DriveType;
    /**
     * @var string
     */
    public $Id;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $Path;
    /**
     * @var string
     */
    public $ShareId;
    /**
     * @var string
     */
    public $SiteId;
    /**
     * @var SharepointIds
     */
    public $SharepointIds;
}