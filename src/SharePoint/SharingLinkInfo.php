<?php

/**
 * Updated By PHP Office365 Generator 2019-10-08T21:51:16+00:00 16.0.19325.12009 
*/
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
class SharingLinkInfo extends ClientValueObject
{
    /** 
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
     * @var string  
     */
    public $Expiration;
    /** 
     * @var bool  
     */
    public $HasExternalGuestInvitees;
    /** 
     * @var array  
     */
    public $Invitations;
    /** 
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
     * @var bool  
     */
    public $IsEditLink;
    /** 
     * @var bool  
     */
    public $IsFormsLink;
    /** 
     * @var bool  
     */
    public $IsReviewLink;
    /** 
     * @var bool  
     */
    public $IsUnhealthy;
    /** 
     * @var string  
     */
    public $LastModified;
    public $LastModifiedBy;
    /** 
     * @var bool  
     */
    public $LimitUseToApplication;
    /** 
     * @var integer  
     */
    public $LinkKind;
    /** 
     * @var string  
     */
    public $PasswordLastModified;
    public $PasswordLastModifiedBy;
    /** 
     * @var bool  
     */
    public $RequiresPassword;
    /** 
     * @var bool  
     */
    public $RestrictedShareMembership;
    /** 
     * @var string  
     */
    public $ShareId;
    /** 
     * @var string  
     */
    public $ShareTokenString;
    /** 
     * @var string  
     */
    public $Url;
}