<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:45:59+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * Microsoft.SharePoint.Client.ListItemComplianceInfo 
 * is not applicable.<264>
 */
class ListItemComplianceInfo extends ClientValueObject
{
    /**
     * @var string
     */
    public $ComplianceTag;
    /**
     * @var bool
     */
    public $TagPolicyEventBased;
    /**
     * @var bool
     */
    public $TagPolicyHold;
    /**
     * @var bool
     */
    public $TagPolicyRecord;
}