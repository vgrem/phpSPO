<?php

/**
 *  2025-08-22T05:41:05+00:00 
 */
namespace Office365\Teams;

use Office365\Directory\Identities\IdentitySet;
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
    /**
     * @var IdentitySet
     */
    public $Mentioned;
}