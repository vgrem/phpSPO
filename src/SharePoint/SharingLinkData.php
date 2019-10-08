<?php

/**
 * Updated By PHP Office365 Generator 2019-10-08T21:51:16+00:00 16.0.19325.12009 
*/
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
class SharingLinkData extends ClientValueObject
{
    /** 
     * @var bool  
     */
    public $BlocksDownload;
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
     * @var bool  
     */
    public $IsAnonymous;
    /** 
     * @var bool  
     */
    public $IsCreateOnlyLink;
    /** 
     * @var bool  
     */
    public $IsFormsLink;
    /** 
     * @var bool  
     */
    public $IsOriginatedFromSharingFlow;
    /** 
     * @var bool  
     */
    public $IsReviewLink;
    /** 
     * @var bool  
     */
    public $IsSharingLink;
    /** 
     * @var bool  
     */
    public $IsWritable;
    /** 
     * @var integer  
     */
    public $LinkKind;
    /** 
     * @var integer  
     */
    public $ObjectType;
    /** 
     * @var string  
     */
    public $ObjectUniqueId;
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
}