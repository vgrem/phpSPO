<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:34:55+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Directory\Provider;

use Office365\PHP\Client\Runtime\ClientValueObject;

class AlternateIdData extends ClientValueObject
{
    /**
     * @var string
     */
    public $Email;
    /**
     * @var integer
     */
    public $IdentifyingProperty;
    /**
     * @var string
     */
    public $UserPrincipalName;
}