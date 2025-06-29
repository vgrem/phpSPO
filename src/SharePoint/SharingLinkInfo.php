<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
use Office365\SharePoint\Sharing\LinkInvitationCollection;
/**
 * Specifies 
 * the information about the tokenized sharing link.
 */
class SharingLinkInfo extends ClientValue
{
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * allows anonymous access.
     * @var bool
     */
    public $AllowsAnonymousAccess;
    /**
     * @var string
     */
    public $ApplicationId;
    /**
     * @var bool
     */
    public $BlocksDownload;
    /**
     * The UTC 
     * date/time string with complete representation for calendar date and time of day 
     * which represents the time and date of creation of the tokenized sharing link. 
     * Format returned from get operation is "YYYY-MM-DDThh:mm:ss.fffZ" 
     * (e.g. "2016-09-22T12:20:10.125Z"), with a null value indicating no 
     * recorded creation date. The date/time string format for set operations conforms 
     * to the ISO 8601:2004(E) complete representation for calendar date and time of 
     * day. Both the minutes and hour value MUST be specified for the difference 
     * between the local and UTC time. Midnight is represented as 00:00:00. For 
     * example: YYYYMMDDThhmmssZ YYYYMMDDThhmmss±hhmm YYYYMMDDThhmmss±hh:mm 
     * YYYYMMDDThhmmssfffZ YYYY-MM-DDThh:mm:ssZ YYYY-MM-DDThh:mm:ss±hh:mm 
     * YYYY-MM-DDThh:mm:ss±hhmm YYYY-MM-DDThh:mm:ss.fffZ.
     * @var string
     */
    public $Created;
    public $CreatedBy;
    /**
     * @var string
     */
    public $Description;
    /**
     * @var bool
     */
    public $Embeddable;
    /**
     * The UTC 
     * date/time string with complete representation for calendar date and time of day 
     * which represents the time and date of expiry for the tokenized sharing link 
     * (i.e. is not accessible anymore). Format returned from get operation is 
     * "YYYY-MM-DDThh:mm:ss.fffZ" (e.g. 
     * "2016-09-22T12:20:10.125Z"), with a null value indicating no expiry. 
     * The date/time string format for set operations conforms to the ISO 8601:2004(E) 
     * complete representation for calendar date and time of day. Both the minutes and 
     * hour value MUST be specified for the difference between the local and UTC time. 
     * Midnight is represented as 00:00:00. For example: YYYYMMDDThhmmssZ YYYYMMDDThhmmss±hhmm 
     * YYYYMMDDThhmmss±hh:mm YYYYMMDDThhmmssfffZ YYYY-MM-DDThh:mm:ssZ 
     * YYYY-MM-DDThh:mm:ss±hh:mm YYYY-MM-DDThh:mm:ss±hhmm YYYY-MM-DDThh:mm:ss.fffZ A 
     * null value indicates no expiry.This value 
     * is only applicable to tokenized sharing links that are anonymous 
     * access links.
     * @var string
     */
    public $Expiration;
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * has any External Guest Invitees (external users explicitly invited by email 
     * address).
     * @var bool
     */
    public $HasExternalGuestInvitees;
    /**
     * Read OnlyThis value 
     * contains the current membership list for principals that have been Invited to 
     * the tokenized 
     * sharing link.
     * @var array
     */
    public $Invitations;
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * is active.
     * @var bool
     */
    public $IsActive;
    /**
     * @var bool
     */
    public $IsAddressBarLink;
    /**
     * @var bool
     */
    public $IsCreateOnlyLink;
    /**
     * @var bool
     */
    public $IsDefault;
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * provides edit access.
     * @var bool
     */
    public $IsEditLink;
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * is a forms link.
     * @var bool
     */
    public $IsFormsLink;
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * provides review access.
     * @var bool
     */
    public $IsReviewLink;
    /**
     * Indicates 
     * the tokenized 
     * sharing link is in unhealthy state and might not work.
     * @var bool
     */
    public $IsUnhealthy;
    /**
     * The UTC 
     * date/time string with complete representation for calendar date and time of day 
     * which represents the time and date of the last update of the settings for the tokenized 
     * sharing link. Format returned from get operation is 
     * "YYYY-MM-DDThh:mm:ss.fffZ" (e.g. 
     * "2016-09-22T12:20:10.125Z"), with a null value indicating no recorded 
     * modification date. The date/time string format for set operations conforms to 
     * the ISO 8601:2004(E) complete representation for calendar date and time of day. 
     * Both the minutes and hour value MUST be specified for the difference between 
     * the local and UTC time. Midnight is represented as 00:00:00. For example: 
     * YYYYMMDDThhmmssZ YYYYMMDDThhmmss±hhmm YYYYMMDDThhmmss±hh:mm YYYYMMDDThhmmssfffZ 
     * YYYY-MM-DDThh:mm:ssZ YYYY-MM-DDThh:mm:ss±hh:mm YYYY-MM-DDThh:mm:ss±hhmm 
     * YYYY-MM-DDThh:mm:ss.fffZ.
     * @var string
     */
    public $LastModified;
    public $LastModifiedBy;
    /**
     * @var bool
     */
    public $LimitUseToApplication;
    /**
     * Specifies 
     * the kind of tokenized sharing link. 
     * 
     * @var integer
     */
    public $LinkKind;
    /**
     * @var string
     */
    public $PasswordLastModified;
    public $PasswordLastModifiedBy;
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * is password protected.
     * @var bool
     */
    public $RequiresPassword;
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * allows access only to the Invitees.
     * @var bool
     */
    public $RestrictedShareMembership;
    /**
     * The unique 
     * share identifier of a tokenized sharing link. 
     * 
     * @var string
     */
    public $ShareId;
    /**
     * @var string
     */
    public $ShareTokenString;
    /**
     * Specifies 
     * the URL 
     * of the tokenized sharing link
     * @var string
     */
    public $Url;
    /**
     * @var integer
     */
    public $Scope;
    /**
     * @var bool
     */
    public $TrackLinkUsers;
    /**
     * @var LinkInvitationCollection
     */
    public $RedeemedUsers;
    /**
     * @var integer
     */
    public $SharingLinkStatus;
    /**
     * @var bool
     */
    public $IsManageListLink;
    /**
     * @var bool
     */
    public $IsEphemeral;
    /**
     * @var string
     */
    public $MeetingId;
    /**
     * @var bool
     */
    public $RestrictToExistingRelationships;
    /**
     * @var bool
     */
    public $MustAlwaysUseLink;
}