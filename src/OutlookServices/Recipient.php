<?php


namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientValueObject;

class Recipient extends ClientValueObject
{

    function __construct(EmailAddress $emailAddress)
    {
        $this->EmailAddress = $emailAddress;
        parent::__construct();
    }

    /**
     * @var EmailAddress
     */
    public $EmailAddress;

}