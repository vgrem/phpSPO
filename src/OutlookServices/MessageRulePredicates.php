<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Common\SizeRange;
use Office365\Runtime\ClientValue;
class MessageRulePredicates extends ClientValue
{
    /**
     * @var array
     */
    public $Categories;
    /**
     * @var array
     */
    public $SubjectContains;
    /**
     * @var array
     */
    public $BodyContains;
    /**
     * @var array
     */
    public $BodyOrSubjectContains;
    /**
     * @var array
     */
    public $SenderContains;
    /**
     * @var array
     */
    public $RecipientContains;
    /**
     * @var array
     */
    public $HeaderContains;
    /**
     * @var bool
     */
    public $SentToMe;
    /**
     * @var bool
     */
    public $SentOnlyToMe;
    /**
     * @var bool
     */
    public $SentCcMe;
    /**
     * @var bool
     */
    public $SentToOrCcMe;
    /**
     * @var bool
     */
    public $NotSentToMe;
    /**
     * @var bool
     */
    public $HasAttachments;
    /**
     * @var bool
     */
    public $IsApprovalRequest;
    /**
     * @var bool
     */
    public $IsAutomaticForward;
    /**
     * @var bool
     */
    public $IsAutomaticReply;
    /**
     * @var bool
     */
    public $IsEncrypted;
    /**
     * @var bool
     */
    public $IsMeetingRequest;
    /**
     * @var bool
     */
    public $IsMeetingResponse;
    /**
     * @var bool
     */
    public $IsNonDeliveryReport;
    /**
     * @var bool
     */
    public $IsPermissionControlled;
    /**
     * @var bool
     */
    public $IsReadReceipt;
    /**
     * @var bool
     */
    public $IsSigned;
    /**
     * @var bool
     */
    public $IsVoicemail;
    /**
     * @var SizeRange
     */
    public $WithinSizeRange;
}