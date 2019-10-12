<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:45:59+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
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
}