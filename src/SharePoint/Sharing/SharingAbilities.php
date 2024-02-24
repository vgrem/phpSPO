<?php

/**
 * Generated  2024-02-24T10:21:51+00:00 16.0.24607.12008
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * the matrix of possible sharing abilities for direct sharing and tokenized 
 * sharing links along with the state of each capability for the 
 * current user.
 */
class SharingAbilities extends ClientValue
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
    /**
     * @var SharingLinkAbilities
     */
    public $anyoneLinkAbilities;
    /**
     * @var bool
     */
    public $canStopSharing;
}