<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:34:55+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\CompliancePolicy;

use Office365\Runtime\ClientValueObject;

class DlpClassificationResult extends ClientValueObject
{
    /**
     * @var string
     */
    public $ClassificationId;
    /**
     * @var integer
     */
    public $Confidence;
    /**
     * @var integer
     */
    public $Count;
}