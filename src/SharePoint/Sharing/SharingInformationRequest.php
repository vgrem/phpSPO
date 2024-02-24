<?php

/**
 * Generated  2024-02-24T10:21:51+00:00 16.0.24607.12008
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * the optional Request Object for 
 * Microsoft.SharePoint.Client.Sharing.SecurableObjectExtensions.GetSharingInformation.
 */
class SharingInformationRequest extends ClientValue
{
    /**
     * Supported 
     * Features (For future use by Office Client).
     * @var string
     */
    public $clientSupportedFeatures;
    /**
     * Maximum 
     * number of principals to return.
     * @var integer
     */
    public $maxPrincipalsToReturn;
    /**
     * @var bool
     */
    public $populateInheritedLinks;
    /**
     * @var integer
     */
    public $maxLinkMembersToReturn;
}