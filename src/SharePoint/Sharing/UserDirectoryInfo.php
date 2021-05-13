<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * User 
 * information from directory service.
 */
class UserDirectoryInfo extends ClientValue
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