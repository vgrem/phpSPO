<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;

class SiteSharingReportStatus extends ClientValue
{
    /**
     * @var integer
     */
    public $errorCode;
    
    public $jobData;
    /**
     * @var string
     */
    public $message;
    /**
     * @var bool
     */
    public $success;
}