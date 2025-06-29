<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
/**
 * Microsoft.SharePoint.Client.CopyMigrationsOptions 
 * is not applicable.<253>
 */
class CopyMigrationOptions extends ClientValue
{
    /**
     * @var bool
     */
    public $AllowSchemaMismatch;
    /**
     * @var bool
     */
    public $AllowSmallerVersionLimitOnDestination;
    /**
     * @var bool
     */
    public $IgnoreVersionHistory;
    /**
     * @var bool
     */
    public $IsMoveMode;
    /**
     * @var integer
     */
    public $NameConflictBehavior;
    public $IncludeItemPermissions;
    public $MoveAndShareFileInfo;
    /**
     * @var bool
     */
    public $BypassSharedLock;
    /**
     * @var array
     */
    public $ClientEtags;
    /**
     * @var bool
     */
    public $MoveButKeepSource;
    /**
     * @var bool
     */
    public $ExcludeChildren;
    /**
     * @var bool
     */
    public $SameWebCopyMoveOptimization;
    /**
     * @var array
     */
    public $CustomizedItemName;
    /**
     * @var bool
     */
    public $MergeEmailNotifications;
    /**
     * @var bool
     */
    public $MoveAndShareItems;
}