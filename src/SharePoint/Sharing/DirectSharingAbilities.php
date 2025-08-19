<?php

/**
 * Generated  2025-08-19T15:30:13+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * the set of capabilities for direct sharing for the current user.
 */
class DirectSharingAbilities extends ClientValue
{
    public $canAddExternalPrincipal;
    public $canAddInternalPrincipal;
    public $canRequestGrantAccess;
    /**
     * @var SharingAbilityStatus
     */
    public $supportsReviewPermission;
    /**
     * @var SharingAbilityStatus
     */
    public $canAddNewExternalPrincipal;
    /**
     * @var SharingAbilityStatus
     */
    public $canRequestGrantAccessForExistingExternalPrincipal;
    /**
     * @var SharingAbilityStatus
     */
    public $canRequestGrantAccessForInternalPrincipal;
    /**
     * @var SharingAbilityStatus
     */
    public $canRequestGrantAccessForNewExternalPrincipal;
    /**
     * @var SharingAbilityStatus
     */
    public $supportsEditPermission;
    /**
     * @var SharingAbilityStatus
     */
    public $supportsManageListPermission;
    /**
     * @var SharingAbilityStatus
     */
    public $supportsReadPermission;
    /**
     * @var SharingAbilityStatus
     */
    public $supportsRestrictedViewPermission;
}