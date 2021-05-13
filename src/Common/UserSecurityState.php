<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class UserSecurityState extends ClientValue
{
    /**
     * @var string
     */
    public $AadUserId;
    /**
     * @var string
     */
    public $AccountName;
    /**
     * @var string
     */
    public $DomainName;
    /**
     * @var bool
     */
    public $IsVpn;
    /**
     * @var string
     */
    public $LogonId;
    /**
     * @var string
     */
    public $LogonIp;
    /**
     * @var string
     */
    public $LogonLocation;
    /**
     * @var string
     */
    public $OnPremisesSecurityIdentifier;
    /**
     * @var string
     */
    public $RiskScore;
    /**
     * @var string
     */
    public $UserPrincipalName;
}