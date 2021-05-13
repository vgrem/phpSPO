<?php

/**
 * Modified: 2020-08-05T10:16:13+00:00 16.0.20315.12009
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * the settings the retrieval or creation/update of a tokenized sharing link
 */
class ShareLinkSettings extends ClientValue
{
    /**
     * Indicates 
     * if the tokenized sharing link 
     * supports anonymous access. This value is optional and defaults to false for Flexible 
     * links (section 3.2.5.315.1.7) and 
     * is ignored for other link kinds.
     * @var bool
     */
    public $allowAnonymousAccess;
    /**
     * @var bool
     */
    public $applicationLink;
    /**
     * @var string
     */
    public $description;
    /**
     * @var bool
     */
    public $embeddable;
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
     * access links
     * @var string
     */
    public $expiration;
    /**
     * Read/WriteOptional 
     * set of invitee principals to remove from an existing sharing link. This applies 
     * only to update operations on existing tokenized sharing links 
     * that have invitees.
     * @var array
     */
    public $inviteesToRemove;
    /**
     * @var bool
     */
    public $limitUseToApplication;
    /**
     * The kind 
     * of the tokenized sharing link 
     * to be created/updated or retrieved.This value 
     * MUST NOT be set to Uninitialized (section 3.2.5.315.1.1) nor Direct 
     * (section 3.2.5.315.1.2)
     * @var integer
     */
    public $linkKind;
    /**
     * @var bool
     */
    public $nonDefaultLink;
    /**
     * Optional 
     * password value to apply to the tokenized sharing link, 
     * if it can support password protection.If this 
     * value is null or empty when the updatePassword parameter is set, any 
     * existing password on the tokenized sharing link MUST be cleared. Any other 
     * value will be applied to the tokenized sharing link as a password setting.
     * @var string
     */
    public $password;
    /**
     * @var bool
     */
    public $passwordProtected;
    /**
     * Indicates 
     * if the tokenized sharing link 
     * restricts share access, allowing only those explicitly invited in advance to 
     * use the link.This value 
     * MUST NOT be true when the allowAnonymousAccess parameter is true or when 
     * the linkKind is any other value than Flexible (section 3.2.5.315.1.7).
     * @var bool
     */
    public $restrictShareMembership;
    /**
     * The role 
     * to be used for the tokenized sharing link. 
     * This is required for Flexible links (section 3.2.5.315.1.7) and 
     * ignored for all other kinds.
     * @var integer
     */
    public $role;
    /**
     * The 
     * optional unique identifier of an existing section tokenized sharing link 
     * to be retrieved and updated if necessary.
     * @var string
     */
    public $shareId;
    /**
     * Indicates 
     * whether to update (set or clear) the password value for the specified tokenized 
     * sharing link. This value is applicable only if the tokenized sharing 
     * link can support password protection.If set to 
     * true, the password value MUST be applied to the new or existing tokenized 
     * sharing link if the link can support password protection. If set to false the 
     * password value in this request MUST be ignored.
     * @var bool
     */
    public $updatePassword;
    /**
     * @var integer
     */
    public $scope;
    /**
     * @var bool
     */
    public $trackLinkUsers;
}