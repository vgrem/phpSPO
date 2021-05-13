<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\OutlookServices\EmailAddress;
use Office365\Runtime\ClientValue;
class MailTips extends ClientValue
{
    /**
     * @var EmailAddress
     */
    public $EmailAddress;
    /**
     * @var bool
     */
    public $MailboxFull;
    /**
     * @var string
     */
    public $CustomMailTip;
    /**
     * @var integer
     */
    public $ExternalMemberCount;
    /**
     * @var integer
     */
    public $TotalMemberCount;
    /**
     * @var bool
     */
    public $DeliveryRestricted;
    /**
     * @var bool
     */
    public $IsModerated;
    /**
     * @var integer
     */
    public $MaxMessageSize;
    /**
     * @var AutomaticRepliesMailTips
     */
    public $AutomaticReplies;
    /**
     * @var MailTipsError
     */
    public $Error;
}