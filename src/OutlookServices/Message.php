<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientObject;

class Message extends ClientObject
{

    /**
     * @var ItemBody
     */
    public $Body;

    /**
     * @var string
     */
    public $Subject;

}