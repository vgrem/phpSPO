<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:41:09+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Social;

use Office365\PHP\Client\Runtime\ClientValueObject;

class SocialFeedOptions extends ClientValueObject
{
    /**
     * @var integer
     */
    public $MaxThreadCount;
    /**
     * @var string
     */
    public $NewerThan;
    /**
     * @var string
     */
    public $OlderThan;
    /**
     * @var integer
     */
    public $SortOrder;
}