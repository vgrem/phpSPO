<?php

/**
 * Updated By PHP Office365 Generator 2019-11-16T20:28:28+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValueObject;
/**
 * Represents 
 * the set of capabilities for direct sharing for the current user.
 */
class DirectSharingAbilities extends ClientValueObject
{
    public $canAddExternalPrincipal;
    public $canAddInternalPrincipal;
    public $canRequestGrantAccess;
    /**
     * @var SharingAbilityStatus
     */
    public $supportsReviewPermission;
}