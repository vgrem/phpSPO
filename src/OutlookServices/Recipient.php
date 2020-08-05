<?php


namespace Office365\OutlookServices;


use Office365\Runtime\ClientValue;


/**
 * Represents information about a user in the sending or receiving end of an event or message.
 */
class Recipient extends ClientValue
{

    function __construct(EmailAddress $emailAddress)
    {
        $this->EmailAddress = $emailAddress;
        parent::__construct();
    }

    /**
     * The recipient's email address.
     * @var EmailAddress
     */
    public $EmailAddress;

}