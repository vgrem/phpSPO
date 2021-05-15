<?php

/**
 * Modified: 2020-05-24T21:58:36+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class Recipient extends ClientValue
{
    function __construct(EmailAddress $emailAddress=null)
    {
        $this->EmailAddress = $emailAddress;
        parent::__construct();
    }

    /**
     * @var EmailAddress
     */
    public $EmailAddress;
}