<?php

/**
 * Generated 2021-08-22T15:28:03+00:00 16.0.21611.12002
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * the set of capabilities for specific configurations of tokenized 
 * sharing link for the current user and whether they are enabled or 
 * not.
 */
class SharingLinkAbilities extends ClientValue
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
    /**
     * @var SharingAbilityStatus
     */
    public $canGetReviewLink;
    /**
     * @var SharingAbilityStatus
     */
    public $canManageReviewLink;
    /**
     * @var SharingAbilityStatus
     */
    public $trackLinkUsers;
    /**
     * @var SharingAbilityStatus
     */
    public $canGetManageListLink;
    /**
     * @var SharingAbilityStatus
     */
    public $canManageManageListLink;
    /**
     * @var SharingAbilityStatus
     */
    public $canDeleteEditLink;
    /**
     * @var SharingAbilityStatus
     */
    public $canDeleteManageListLink;
    /**
     * @var SharingAbilityStatus
     */
    public $canDeleteReadLink;
    /**
     * @var SharingAbilityStatus
     */
    public $canDeleteReviewLink;
}