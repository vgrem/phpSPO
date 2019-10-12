<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\SharePoint\SharingLinkInfo;

/**
 * Represents 
 * a response for a request for the retrieval or creation/update of a tokenized 
 * sharing link. 
 */
class ShareLinkResponse extends ClientValueObject
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
