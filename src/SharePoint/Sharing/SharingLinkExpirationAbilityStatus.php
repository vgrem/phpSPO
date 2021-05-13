<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * expiration capabilities status for tokenized sharing links 
 * for the current user.
 */
class SharingLinkExpirationAbilityStatus extends ClientValue
{
    /**
     * Indicates 
     * the default expiration value.
     * @var integer
     */
    public $defaultExpirationInDays;
}