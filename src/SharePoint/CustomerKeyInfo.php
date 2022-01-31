<?php

/**
 * Generated 2021-08-22T15:28:03+00:00 16.0.21611.12002
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
/**
 * Microsoft.SharePoint.Client.CustomerKeyInfo 
 * is not applicable.<254>
 */
class CustomerKeyInfo extends ClientValue
{
    public $PrimaryKeyVault;
    public $SecondaryKeyVault;
    /**
     * @var CustomerKeyVaultInfo
     */
    public $RecoveryKeyVault;
    /**
     * @var CustomerKeyVaultInfo
     */
    public $AvailabilityKeyVault;
}