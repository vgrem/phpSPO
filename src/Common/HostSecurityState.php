<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class HostSecurityState extends ClientValue
{
    /**
     * @var string
     */
    public $Fqdn;
    /**
     * @var bool
     */
    public $IsAzureAdJoined;
    /**
     * @var bool
     */
    public $IsAzureAdRegistered;
    /**
     * @var bool
     */
    public $IsHybridAzureDomainJoined;
    /**
     * @var string
     */
    public $NetBiosName;
    /**
     * @var string
     */
    public $Os;
    /**
     * @var string
     */
    public $PrivateIpAddress;
    /**
     * @var string
     */
    public $PublicIpAddress;
    /**
     * @var string
     */
    public $RiskScore;
}