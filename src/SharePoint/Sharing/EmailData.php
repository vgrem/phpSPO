<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * Represents 
 * email data to be used to initiate sending notification e-mail when sharing 
 * using a tokenized sharing link.
 */
class EmailData extends ClientValueObject
{
    /**
     * The value 
     * to use as the custom message body for a notification e-mail when sharing using 
     * a tokenized 
     * sharing link.If this 
     * value is null, the default message body MUST be used.
     * @var string
     */
    public $body;
    /**
     * The value 
     * to use as the custom subject line for a notification e-mail when sharing using 
     * a tokenized 
     * sharing link.If this 
     * value is null, the default subject line MUST be used.
     * @var string
     */
    public $subject;
}