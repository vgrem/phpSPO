<?php

/**
 *  2025-08-21T20:35:45+00:00 
 */
namespace Office365\OneDrive\DriveItems;

use Office365\Directory\Identities\IdentitySet;
use Office365\OneDrive\ItemReference;
use Office365\OneDrive\SharepointIds;
use Office365\OneDrive\Shares\Shared;
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
    /**
     * @var Image
     */
    public $Image;
    /**
     * @var Video
     */
    public $Video;
}