<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * extended values to include in a request for access to an object exposed through 
 * a tokenized 
 * sharing link.
 */
class SharingLinkAccessRequest extends ClientValue
{
    /**
     * Indicates 
     * if the request to the tokenized sharing link 
     * grants perpetual access to the calling user.
     * @var bool
     */
    public $ensureAccess;
    /**
     * This value 
     * contains the password to be supplied to a tokenized sharing link 
     * for validation. This value is only needed if the link requires a password 
     * before granting access and the calling user does not currently have perpetual 
     * access through the tokenized sharing link.This value 
     * MUST be set to the correct password for the tokenized sharing link for the 
     * access granting operation to succeed. If the tokenized sharing link does not 
     * require a password or the calling user already has perpetual access through the 
     * tokenized sharing link, this value will be ignored. 
     * @var string
     */
    public $password;
}