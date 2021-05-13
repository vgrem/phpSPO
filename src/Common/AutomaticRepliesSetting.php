<?php

/**
 * Modified: 2020-05-24T22:06:36+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class AutomaticRepliesSetting extends ClientValue
{
    /**
     * @var string
     */
    public $InternalReplyMessage;
    /**
     * @var string
     */
    public $ExternalReplyMessage;
    /**
     * @var DateTimeTimeZone
     */
    public $ScheduledStartDateTime;
    /**
     * @var DateTimeTimeZone
     */
    public $ScheduledEndDateTime;
}