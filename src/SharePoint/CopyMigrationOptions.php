<?php

/**
 * Updated By PHP Office365 Generator 2020-04-22T21:18:30+00:00 16.0.20008.12009
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
}