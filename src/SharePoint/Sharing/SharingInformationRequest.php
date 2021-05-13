<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
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
}