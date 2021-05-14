<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\IdentitySet;
use Office365\Runtime\ClientValue;
class RemoteItem extends ClientValue
{
    /**
     * @var string
     */
    public $Id;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var integer
     */
    public $Size;
    /**
     * @var string
     */
    public $WebDavUrl;
    /**
     * @var string
     */
    public $WebUrl;
    /**
     * @var IdentitySet
     */
    public $CreatedBy;
    /**
     * @var File
     */
    public $File;
    /**
     * @var FileSystemInfo
     */
    public $FileSystemInfo;
    /**
     * @var Folder
     */
    public $Folder;
    /**
     * @var IdentitySet
     */
    public $LastModifiedBy;
    /**
     * @var Package
     */
    public $Package;
    /**
     * @var ItemReference
     */
    public $ParentReference;
    /**
     * @var Shared
     */
    public $Shared;
    /**
     * @var SharepointIds
     */
    public $SharepointIds;
    /**
     * @var SpecialFolder
     */
    public $SpecialFolder;
}