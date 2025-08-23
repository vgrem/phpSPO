<?php

/**
 *  2025-08-22T05:41:05+00:00 
 */
namespace Office365\Communications;

use Office365\Directory\Identities\IdentitySet;
use Office365\Runtime\ClientValue;
class IncomingContext extends ClientValue
{
    /**
     * @var string
     */
    public $SourceParticipantId;
    /**
     * @var string
     */
    public $ObservedParticipantId;
    /**
     * @var IdentitySet
     */
    public $OnBehalfOf;
    /**
     * @var IdentitySet
     */
    public $Transferor;
}