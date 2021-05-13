<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Intune;

use Office365\Common\MimeContent;
use Office365\Common\RgbColor;
use Office365\Runtime\ClientValue;
class IntuneBrand extends ClientValue
{
    /**
     * @var string
     */
    public $DisplayName;
    /**
     * @var string
     */
    public $ContactITName;
    /**
     * @var string
     */
    public $ContactITPhoneNumber;
    /**
     * @var string
     */
    public $ContactITEmailAddress;
    /**
     * @var string
     */
    public $ContactITNotes;
    /**
     * @var string
     */
    public $PrivacyUrl;
    /**
     * @var string
     */
    public $OnlineSupportSiteUrl;
    /**
     * @var string
     */
    public $OnlineSupportSiteName;
    /**
     * @var bool
     */
    public $ShowLogo;
    /**
     * @var MimeContent
     */
    public $LightBackgroundLogo;
    /**
     * @var MimeContent
     */
    public $DarkBackgroundLogo;
    /**
     * @var bool
     */
    public $ShowNameNextToLogo;
    /**
     * @var bool
     */
    public $ShowDisplayNameNextToLogo;
    /**
     * @var RgbColor
     */
    public $ThemeColor;
}