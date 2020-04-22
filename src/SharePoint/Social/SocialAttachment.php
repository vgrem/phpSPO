<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:39:07+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Social;

use Office365\Runtime\ClientValueObject;

class SocialAttachment extends ClientValueObject
{
    /**
     * @var integer
     */
    public $AttachmentKind;
    
    public $ClickAction;
    /**
     * @var string
     */
    public $ContentUri;
    /**
     * @var string
     */
    public $Description;
    /**
     * @var integer
     */
    public $Height;
    /**
     * @var integer
     */
    public $Length;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var integer
     */
    public $PreviewHeight;
    /**
     * @var string
     */
    public $PreviewUri;
    /**
     * @var integer
     */
    public $PreviewWidth;
    /**
     * @var string
     */
    public $Uri;
    /**
     * @var integer
     */
    public $Width;
}