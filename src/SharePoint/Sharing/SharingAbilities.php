<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * Represents 
 * the matrix of possible sharing abilities for direct sharing and tokenized 
 * sharing links along with the state of each capability for the 
 * current user.
 */
class SharingAbilities extends ClientValueObject
{
    
    public $anonymousLinkAbilities;
    /**
     * Indicates 
     * abilities for direct sharing of a document using the canonical 
     * URL.
     * @var DirectSharingAbilities
     */
    public $directSharingAbilities;
    
    public $organizationLinkAbilities;
    
    public $peopleSharingLinkAbilities;
}
