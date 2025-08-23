<?php

/**
 *  2025-08-22T05:43:25+00:00 
 */
namespace Office365\Teams;

use Office365\Directory\Identities\IdentitySet;
use Office365\Runtime\ClientValue;
class ChatMessageReaction extends ClientValue
{
    /**
     * @var string
     */
    public $ReactionType;
    /**
     * @var IdentitySet
     */
    public $User;
}