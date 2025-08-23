<?php

/**
 *  2025-08-22T05:43:25+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class ChatMessagePolicyViolation extends ClientValue
{
    /**
     * @var string
     */
    public $JustificationText;
    /**
     * @var ChatMessagePolicyViolationPolicyTip
     */
    public $PolicyTip;
}