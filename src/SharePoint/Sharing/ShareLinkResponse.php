<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
use Office365\SharePoint\SharingLinkInfo;

/**
 * Represents 
 * a response for a request for the retrieval or creation/update of a tokenized 
 * sharing link. 
 */
class ShareLinkResponse extends ClientValue
{
    /**
     * A data 
     * structure that represents the settings and information about the tokenized 
     * sharing link. This MUST be populated if the sharing operation is 
     * returning a tokenized sharing link.
     * @var SharingLinkInfo
     */
    public $sharingLinkInfo;
}
