<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * a request for the retrieval or creation of a tokenized sharing link. 
 * 
 */
class ShareLinkRequest extends ClientValue
{
    /**
     * Indicates 
     * whether the operation attempts to create the tokenized sharing link 
     * based on the requested settings if it does not currently exist.If set to 
     * true, the operation will attempt to retrieve an existing tokenized sharing link 
     * that matches the requested settings and failing that will attempt to create a 
     * new tokenized sharing link based on the requested settings. If false, the 
     * operation will attempt to retrieve an existing tokenized sharing link that 
     * matches the requested settings and failing that will terminate the operation.
     * @var bool
     */
    public $createLink;
    
    public $emailData;
    /**
     * A 
     * date/time string for which the format conforms to the ISO 8601:2004(E) complete 
     * representation for calendar date and time of day and which represents the time 
     * and date of expiry for the tokenized sharing link. 
     * Both the minutes and hour value MUST be specified for the difference between 
     * the local and UTC time. Midnight is represented as 00:00:00. For example: 
     * YYYYMMDDThhmmssZ YYYYMMDDThhmmss±hhmm YYYYMMDDThhmmss±hh:mm YYYYMMDDThhmmssfffZ 
     * YYYY-MM-DDThh:mm:ssZ YYYY-MM-DDThh:mm:ss±hh:mm YYYY-MM-DDThh:mm:ss±hhmm 
     * YYYY-MM-DDThh:mm:ss.fffZ A null value indicates no expiry.This value 
     * is only applicable to tokenized sharing links that are anonymous 
     * access links.This value MAY be set however it is considered obsolete. 
     * This value is superseded by an equivalent expiration value (section 3.2.5.446.1.1.2) 
     * of the settings object stored in the settings field (section 3.2.5.444.1.1.6).
     * @var string
     */
    public $expiration;
    /**
     * The kind 
     * of the tokenized sharing link 
     * to be created/updated or retrieved.This value 
     * MAY be set however it is considered obsolete. This value is superseded by an 
     * equivalent linkKind value (section 3.2.5.446.1.1.4) of 
     * the settings object stored in the settings field (section 3.2.5.444.1.1.6).
     * @var integer
     */
    public $linkKind;
    /**
     * A string 
     * of JSON 
     * serialized data representing users in people picker format. This value 
     * specifies a list of identities that will be pre-granted access through the tokenized 
     * sharing link and optionally sent an e-mail notification.If this 
     * value is null or empty, no identities will be will be pre-granted access 
     * through the tokenized sharing link and no notification email will be sent.
     * @var string
     */
    public $peoplePickerInput;
    
    public $settings;
}