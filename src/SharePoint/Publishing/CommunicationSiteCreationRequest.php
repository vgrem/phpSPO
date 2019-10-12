<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:41:09+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Publishing;

use Office365\PHP\Client\Runtime\ClientValueObject;

class CommunicationSiteCreationRequest extends ClientValueObject
{
    /**
     * @var bool
     */
    public $AllowFileSharingForGuestUsers;
    /**
     * @var string
     */
    public $Classification;
    /**
     * @var string
     */
    public $Description;
    /**
     * @var integer
     */
    public $lcid;
    /**
     * @var string
     */
    public $SensitivityLabel;
    /**
     * @var string
     */
    public $SensitivityLabel2;
    /**
     * @var string
     */
    public $SiteDesignId;
    /**
     * @var string
     */
    public $Title;
    /**
     * @var string
     */
    public $Url;
    /**
     * @var string
     */
    public $WebTemplateExtensionId;
}