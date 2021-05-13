<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

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
}