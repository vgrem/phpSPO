<?php

/**
 * Generated  2025-08-19T15:30:13+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents
 * the matrix of possible sharing abilities for direct sharing and tokenized
 * sharing links along with the state of each capability for the
 * current user.
 */
class MainLinkAbilities extends ClientValue
{
    /**
     * @var mixed
     */
    public $mainLinkAudienceAbilities;
    /**
     * @var mixed
     */
    public $mainLinkRoleAbilities;
    /**
     * @var SharingAbilityStatus
     */
    public $canGetLink;
    /**
     * @var SharingAbilityStatus
     */
    public $canManageLink;
    /**
     * @var SharingAbilityStatus
     */
    public $canResetLink;
}