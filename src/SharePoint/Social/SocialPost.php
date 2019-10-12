<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:41:09+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Social;

use Office365\PHP\Client\Runtime\ClientValueObject;

class SocialPost extends ClientValueObject
{
    /**
     * @var SocialAttachment
     */
    public $Attachment;
    /**
     * @var integer
     */
    public $Attributes;
    /**
     * @var integer
     */
    public $AuthorIndex;
    /**
     * @var string
     */
    public $CreatedTime;
    /**
     * @var string
     */
    public $Id;
    
    public $LikerInfo;
    /**
     * @var string
     */
    public $ModifiedTime;
    /**
     * @var array
     */
    public $Overlays;
    /**
     * @var integer
     */
    public $PostType;
    /**
     * @var string
     */
    public $PreferredImageUri;
    
    public $Source;
    /**
     * @var string
     */
    public $Text;
}
