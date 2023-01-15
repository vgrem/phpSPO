<?php

/**
 * Modified: 2020-05-24T21:52:14+00:00 
 */
namespace Office365\Outlook;

use Office365\Complex;

class EmailAddress extends Complex
{
    /**
     * @param string $name
     * @param string $address
     */
    public function __construct($name=null, $address=null)
    {
        $this->Name = $name;
        $this->Address = $address;
        parent::__construct();
    }

    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $Address;
}