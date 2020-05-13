<?php

/**
 * Updated By PHP Office365 Generator 2020-05-13T12:17:52+00:00 16.0.20029.12010
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
/**
 * Microsoft.SharePoint.Client.CopyMigrationsOptions 
 * is not applicable.<253>
 */
class CopyMigrationOptions extends ClientValueObject
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
}