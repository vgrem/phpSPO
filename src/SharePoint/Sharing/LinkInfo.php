<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\SharePoint\SharingLinkInfo;

/**
 * This class 
 * provides metadata for the tokenized sharing link 
 * including settings details, inheritance status, and an optional array of 
 * members.
 */
class LinkInfo extends ClientValueObject
{
    /**
     * Boolean that 
     * indicates if the tokenized sharing link 
     * is present due to inherited permissions from a parent object.
     * @var bool
     */
    public $isInherited;
    /**
     * The 
     * SharingLinkInfo object for the tokenized sharing link 
     * with encoded Url.
     * @var SharingLinkInfo
     */
    public $linkDetails;
    /**
     * Read/WriteList of 
     * principals present on the tokenized sharing link. 
     * The number 
     * of principals returned in this array MUST not exceed 30, and any excess principals 
     * on the tokenized sharing link MUST NOT be included. 
     * @var array
     */
    public $linkMembers;
}
