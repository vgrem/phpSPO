<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class DriveRecipient extends ClientValue
{
    /**
     * @var string
     */
    public $Alias;
    /**
     * @var string
     */
    public $Email;
    /**
     * @var string
     */
    public $ObjectId;
}