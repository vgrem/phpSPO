<?php

/**
 * Generated  2025-08-18T13:00:23+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientValue;
class PublishingStatusResponse extends ClientValue
{
    /**
     * @var string
     */
    public $LastTriedAt;
    /**
     * @var integer
     */
    public $PrePublishValidationErrorCode;
    /**
     * @var integer
     */
    public $PublishingStatus;
    /**
     * @var VivaEngagePublishingStatus
     */
    public $VivaEngagePublishingStatus;
    /**
     * @var EmailPublishingStatus
     */
    public $EmailPublishingStatus;
}