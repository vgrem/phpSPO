<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:39:07+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Directory\Provider;

use Office365\Runtime\ClientValueObject;

class DirectoryObjectData extends ClientValueObject
{
    /**
     * @var AlternateIdData
     */
    public $AlternateId;
    /**
     * @var array
     */
    public $AttributeExpirationTimes;
    /**
     * @var string
     */
    public $ChangeMarker;
    /**
     * @var integer
     */
    public $DirectoryObjectSubType;
    /**
     * @var integer
     */
    public $DirectoryObjectType;
    /**
     * @var string
     */
    public $Id;
    /**
     * @var bool
     */
    public $IsNew;
    /**
     * @var string
     */
    public $LastModifiedTime;
    /**
     * @var string
     */
    public $TenantContextId;
    /**
     * @var integer
     */
    public $Version;
}
