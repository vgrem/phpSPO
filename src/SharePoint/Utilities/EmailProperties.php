<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Utilities;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * Specifies 
 * the definition of the email to send which includes both the message fields and 
 * body.<215>
 */
class EmailProperties extends ClientValueObject
{
    /**
     * Specifies 
     * the email headers collection that corresponds to any additional fields of the 
     * message.
     * @var array
     */
    public $AdditionalHeaders;
    /**
     * Accessibility: Read/WriteSpecifies 
     * the blind 
     * carbon copy (bcc) recipients of the email.
     * @var array
     */
    public $BCC;
    /**
     * Specifies 
     * the message 
     * body to send.
     * @var string
     */
    public $Body;
    /**
     * Accessibility: Read/WriteSpecifies 
     * the blind 
     * carbon copy (bcc) recipients of the email.
     * @var array
     */
    public $CC;
    /**
     * Specifies 
     * the From field of the email.
     * @var string
     */
    public $From;
    /**
     * Specifies 
     * the Subject field of the e-mail.
     * @var string
     */
    public $Subject;
    /**
     * Accessibility: Read/WriteSpecifies 
     * the To field of the email.
     * @var array
     */
    public $To;
}