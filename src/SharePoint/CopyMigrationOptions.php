<?php

/**
 * Updated By PHP Office365 Generator 2019-10-26T18:29:48+00:00 16.0.19416.12016
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
}