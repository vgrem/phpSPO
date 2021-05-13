<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class NetworkConnection extends ClientValue
{
    /**
     * @var string
     */
    public $ApplicationName;
    /**
     * @var string
     */
    public $DestinationAddress;
    /**
     * @var string
     */
    public $DestinationDomain;
    /**
     * @var string
     */
    public $DestinationPort;
    /**
     * @var string
     */
    public $DestinationUrl;
    /**
     * @var string
     */
    public $LocalDnsName;
    /**
     * @var string
     */
    public $NatDestinationAddress;
    /**
     * @var string
     */
    public $NatDestinationPort;
    /**
     * @var string
     */
    public $NatSourceAddress;
    /**
     * @var string
     */
    public $NatSourcePort;
    /**
     * @var string
     */
    public $RiskScore;
    /**
     * @var string
     */
    public $SourceAddress;
    /**
     * @var string
     */
    public $SourcePort;
    /**
     * @var string
     */
    public $UrlParameters;
}