<?php

namespace Office365\PHP\Client\OutlookServices;
use Office365\PHP\Client\Runtime\ClientValueObject;

/**
 * The name and email address of a contact or message recipient.
 */
class EmailAddress extends ClientValueObject
{

    /**
     * EmailAddress constructor.
     * @param string $name
     * @param string $address
     */
    public function __construct($name, $address)
    {
        $this->Name = $name;
        $this->Address = $address;
        parent::__construct();
    }

    /**
     * The display name of the person or entity.
     * @var string
     */
    public $Name;


    /**
     * The email address of the person or entity.
     * @var string
     */
    public $Address;

}