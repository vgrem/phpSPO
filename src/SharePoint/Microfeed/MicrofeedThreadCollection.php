<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:39:07+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Microfeed;

use Office365\Runtime\ClientValueObject;

class MicrofeedThreadCollection extends ClientValueObject
{
    /**
     * @var integer
     */
    public $CurrentUserUnreadMentionCount;
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
    public $Items;
}