<?php

/**
 * Generated  2024-03-17T10:39:33+00:00 16.0.24628.12008
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
}