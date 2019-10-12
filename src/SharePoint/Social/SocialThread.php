<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:41:09+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Social;

use Office365\PHP\Client\Runtime\ClientValueObject;

class SocialThread extends ClientValueObject
{
    /**
     * @var array
     */
    public $Actors;
    /**
     * @var integer
     */
    public $Attributes;
    /**
     * @var string
     */
    public $Id;
    /**
     * @var integer
     */
    public $OwnerIndex;
    /**
     * @var string
     */
    public $Permalink;
    
    public $PostReference;
    /**
     * @var array
     */
    public $Replies;
    
    public $RootPost;
    /**
     * @var integer
     */
    public $Status;
    /**
     * @var integer
     */
    public $ThreadType;
    /**
     * @var integer
     */
    public $TotalReplyCount;
}