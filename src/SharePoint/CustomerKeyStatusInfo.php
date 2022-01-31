<?php

/**
 * Generated 2021-08-22T15:28:03+00:00 16.0.21611.12002
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
/**
 * Microsoft.SharePoint.Client.CustomerKeyStatusInfo 
 * is not applicable.<256>
 */
class CustomerKeyStatusInfo extends ClientValue
{
    /**
     * @var string
     */
    public $PrimaryKeyVaultUri;
    /**
     * @var bool
     */
    public $RecoveryEnabled;
    /**
     * @var string
     */
    public $SecondaryKeyVaultUri;
    /**
     * Microsoft.SharePoint.Client.CustomerKeyStatusInfo 
     * is not applicable.<256>
     * @var integer
     */
    public $Status;
    /**
     * @var string
     */
    public $AvailabilityKeyVaultUri;
    /**
     * @var double
     */
    public $RegistrationProgress;
}