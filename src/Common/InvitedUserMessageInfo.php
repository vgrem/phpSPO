<?php

/**
 * Modified: 2020-05-24T21:52:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class InvitedUserMessageInfo extends ClientValue
{
    /**
     * @var string
     */
    public $MessageLanguage;
    /**
     * @var string
     */
    public $CustomizedMessageBody;
}