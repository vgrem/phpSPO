<?php

namespace Office365\OutlookServices;
use Office365\Runtime\ClientValue;

/**
 * The name and email address of a contact or message recipient.
 */
class EmailAddress extends ClientValue
{

    /**
     * EmailAddress constructor.
     * @param string $typeName
     * @param string $address
     */
    public function __construct($typeName, $address)
    {
        $this->Name = $typeName;
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