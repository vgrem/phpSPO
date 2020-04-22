<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValueObject;
/**
 * Represents 
 * expiration capabilities status for tokenized sharing links 
 * for the current user.
 */
class SharingLinkExpirationAbilityStatus extends ClientValueObject
{
    /**
     * Indicates 
     * the default expiration value.
     * @var integer
     */
    public $defaultExpirationInDays;
}