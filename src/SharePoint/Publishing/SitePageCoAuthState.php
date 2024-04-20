<?php

/**
 * Generated  2024-04-20T08:07:39+00:00 16.0.24803.12007
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientValue;
class SitePageCoAuthState extends ClientValue
{
    /**
     * @var integer
     */
    public $Action;
    /**
     * @var string
     */
    public $SharedLockId;
    /**
     * @var bool
     */
    public $HasReachedMinorVersionsLimit;
    /**
     * @var bool
     */
    public $IsNewSession;
    /**
     * @var integer
     */
    public $LockAction;
    /**
     * @var integer
     */
    public $LockDuration;
    /**
     * @var bool
     */
    public $OverwriteExistingVersion;
    /**
     * @var bool
     */
    public $IsPartitionFlushed;
}