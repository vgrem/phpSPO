<?php

/**
 * Updated By PHP Office365 Generator 2020-01-12T18:07:40+00:00 16.0.19527.12070
 */
namespace Office365\PHP\Client\SharePoint\Social;

use Office365\PHP\Client\Runtime\ClientValueObject;
class SocialActor extends ClientValueObject
{
    public $Status;
    public $StatusText;
    public $TagGuid;
    public $Title;
    public $Uri;
    /**
     * @var integer
     */
    public $ActorType;
    /**
     * @var string
     */
    public $AccountName;
    /**
     * @var bool
     */
    public $CanFollow;
    /**
     * @var string
     */
    public $ContentUri;
    /**
     * @var string
     */
    public $EmailAddress;
    /**
     * @var string
     */
    public $FollowedContentUri;
    /**
     * @var string
     */
    public $Id;
    /**
     * @var string
     */
    public $ImageUri;
    /**
     * @var bool
     */
    public $IsFollowed;
    /**
     * @var string
     */
    public $LibraryUri;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $PersonalSiteUri;
}