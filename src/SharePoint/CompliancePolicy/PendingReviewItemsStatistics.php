<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:32:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\CompliancePolicy;

use Office365\PHP\Client\Runtime\ClientValueObject;

class PendingReviewItemsStatistics extends ClientValueObject
{
    /**
     * @var string
     */
    public $LabelId;
    /**
     * @var string
     */
    public $LabelName;
    /**
     * @var integer
     */
    public $PendingReviewItemsCount;
}