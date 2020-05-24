<?php

/**
 * Updated By PHP Office365 Generator 2020-05-24T09:55:32+00:00 16.0.20113.12008
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientValueObject;
class PortalHealthStatusDetails extends ClientValueObject
{
    /**
     * @var string
     */
    public $ErrorReason;
    /**
     * @var string
     */
    public $HelpLink;
    /**
     * @var integer
     */
    public $PortalHealthErrorCode;
    /**
     * @var integer
     */
    public $Status;
}