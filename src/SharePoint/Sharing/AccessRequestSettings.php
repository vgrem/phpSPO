<?php

/**
 * Modified: 2019-10-12T20:07:53+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * This class 
 * returns the access request settings. It’s an optional property that can be 
 * retrieved in 
 * Microsoft.SharePoint.Client.Sharing.SecurableObjectExtensions.GetSharingInformation() 
 * call on a list item.
 */
class AccessRequestSettings extends ClientValue
{
    /**
     * Boolean 
     * indicating whether there are pending access requests for the list item.
     * @var bool
     */
    public $hasPendingAccessRequests;
    /**
     * The full URL 
     * to the access requests page for the list item, or an 
     * empty string if the link is not available.
     * @var string
     */
    public $pendingAccessRequestsLink;
    /**
     * Boolean 
     * indicating whether the current user’s access on the list item requires 
     * approval from admin for sharing to others.
     * @var bool
     */
    public $requiresAccessApproval;
}