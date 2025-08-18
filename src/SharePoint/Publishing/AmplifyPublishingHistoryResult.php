<?php

/**
 * Generated  2025-08-18T13:00:23+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientValue;
class AmplifyPublishingHistoryResult extends ClientValue
{
    /**
     * @var string
     */
    public $AmplifyId;
    /**
     * @var integer
     */
    public $PageId;
    /**
     * @var string
     */
    public $PublicationMetadata;
    /**
     * @var PublishingStatusResponse
     */
    public $publishingStatusResponse;
    /**
     * @var string
     */
    public $TimestampUTC;
}