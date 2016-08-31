<?php


namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientValueObject;

class SendMailInformation extends ClientValueObject
{
    /**
     * @var Message
     */
    public $Message;

    /**
     * @var bool
     */
    public $SaveToSentItems;

    /**
     * SendMailInformation constructor.
     * @param Message $message
     * @param bool $saveToSentItems
     */
    function __construct(Message $message,$saveToSentItems)
    {
        $this->Message = $message;
        $this->SaveToSentItems = $saveToSentItems;
        parent::__construct();
    }


}