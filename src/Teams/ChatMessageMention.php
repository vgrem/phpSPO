<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class ChatMessageMention extends ClientValue
{
    /**
     * @var integer
     */
    public $Id;
    /**
     * @var string
     */
    public $MentionText;
}