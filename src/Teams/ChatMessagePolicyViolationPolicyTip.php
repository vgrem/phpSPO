<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class ChatMessagePolicyViolationPolicyTip extends ClientValue
{
    /**
     * @var string
     */
    public $GeneralText;
    /**
     * @var string
     */
    public $ComplianceUrl;
    /**
     * @var array
     */
    public $MatchedConditionDescriptions;
}