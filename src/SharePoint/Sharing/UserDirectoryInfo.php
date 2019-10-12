<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * User 
 * information from directory service.
 */
class UserDirectoryInfo extends ClientValueObject
{
    /**
     * Name of the 
     * directory user.
     * @var string
     */
    public $Name;
    /**
     * User NetId 
     * property in directory.
     * @var string
     */
    public $NetId;
    /**
     * User 
     * primary email of the directory user. E.g. user@domain.com.
     * @var string
     */
    public $PrimaryEmail;
    /**
     * Principal 
     * name of the directory user. E.g. user@domain.com.
     * @var string
     */
    public $PrincipalName;
}