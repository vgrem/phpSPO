<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * Represents 
 * the set of capabilities for specific configurations of tokenized 
 * sharing link for the current user and whether they are enabled or 
 * not.
 */
class SharingLinkAbilities extends ClientValueObject
{
    /**
     * @var SharingAbilityStatus
     */
    public $canAddNewExternalPrincipals;
    /**
     * Indicates 
     * whether the current user can get an existing tokenized sharing link 
     * that provides edit access.
     * @var SharingAbilityStatus
     */
    public $canGetEditLink;
    /**
     * Indicates 
     * whether the current user can get an existing tokenized sharing link 
     * that provides read access.
     * @var SharingAbilityStatus
     */
    public $canGetReadLink;
    /**
     * Indicates 
     * whether the tokenized sharing link 
     * supports external users.
     * @var SharingAbilityStatus
     */
    public $canHaveExternalUsers;
    /**
     * Indicates 
     * whether current user can create/manage a tokenized sharing link 
     * that provides edit access.
     * @var SharingAbilityStatus
     */
    public $canManageEditLink;
    /**
     * Indicates 
     * whether the current user can create/manage a tokenized sharing link 
     * that provides read access.
     * @var SharingAbilityStatus
     */
    public $canManageReadLink;
    
    public $linkExpiration;
    
    public $passwordProtected;
    /**
     * @var SharingAbilityStatus
     */
    public $supportsRestrictedView;
}
