<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:07:53+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * Represents 
 * the set of capabilities for direct sharing for the current user.
 */
class DirectSharingAbilities extends ClientValueObject
{
    
    public $canAddExternalPrincipal;
    
    public $canAddInternalPrincipal;
    
    public $canRequestGrantAccess;
}