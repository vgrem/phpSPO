<?php

/**
 * The name and email address of a contact or message recipient.
 */
class EmailAddress
{

    /**
     * EmailAddress constructor.
     * @param string $name
     * @param string $address
     */
    public function __construct($name,$address)
    {
        $this->Name = $name;
        $this->Address = $address;
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
    public  $Address;

}