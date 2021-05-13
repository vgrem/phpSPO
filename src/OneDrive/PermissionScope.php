<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class PermissionScope extends ClientValue
{
    /**
     * @var string
     */
    public $AdminConsentDescription;
    /**
     * @var string
     */
    public $AdminConsentDisplayName;
    /**
     * @var string
     */
    public $Id;
    /**
     * @var bool
     */
    public $IsEnabled;
    /**
     * @var string
     */
    public $Origin;
    /**
     * @var string
     */
    public $Type;
    /**
     * @var string
     */
    public $UserConsentDescription;
    /**
     * @var string
     */
    public $UserConsentDisplayName;
    /**
     * @var string
     */
    public $Value;
}