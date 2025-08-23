<?php

/**
 *  2025-08-22T05:38:57+00:00 
 */
namespace Office365\Intune;

use Office365\Runtime\ClientValue;

class SharedPCAccountManagerPolicy extends ClientValue
{
    /**
     * @var integer
     */
    public $CacheAccountsAboveDiskFreePercentage;
    /**
     * @var integer
     */
    public $InactiveThresholdDays;
    /**
     * @var integer
     */
    public $RemoveAccountsBelowDiskFreePercentage;
}