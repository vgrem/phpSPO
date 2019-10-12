<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:41:09+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\UserProfiles;

use Office365\PHP\Client\Runtime\ClientValueObject;

class CrossGeoSyncUserProperty extends ClientValueObject
{
    /**
     * @var string
     */
    public $DsGuid;
    /**
     * @var bool
     */
    public $IsMultivalue;
    /**
     * @var integer
     */
    public $Privacy;
    /**
     * @var integer
     */
    public $PropertyId;
    /**
     * @var string
     */
    public $PropertyVal;
    /**
     * @var string
     */
    public $SecondaryVal;
}