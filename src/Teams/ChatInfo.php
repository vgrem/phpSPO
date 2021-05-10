<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class ChatInfo extends ClientValue
{
    /**
     * @var string
     */
    public $ThreadId;
    /**
     * @var string
     */
    public $MessageId;
    /**
     * @var string
     */
    public $ReplyChainMessageId;
}