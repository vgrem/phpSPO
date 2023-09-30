<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
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
}