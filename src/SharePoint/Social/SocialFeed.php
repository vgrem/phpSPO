<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:41:09+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Social;

use Office365\PHP\Client\Runtime\ClientValueObject;

class SocialFeed extends ClientValueObject
{
    /**
     * @var integer
     */
    public $Attributes;
    /**
     * @var string
     */
    public $NewestProcessed;
    /**
     * @var string
     */
    public $OldestProcessed;
    /**
     * @var array
     */
    public $Threads;
    /**
     * @var integer
     */
    public $UnreadMentionCount;
}