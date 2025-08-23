<?php

/**
 *  2025-08-22T05:41:05+00:00 
 */
namespace Office365\Intune;

use Office365\Runtime\ClientValue;

class UpdateWindowsDeviceAccountActionParameter extends ClientValue
{
    /**
     * @var bool
     */
    public $PasswordRotationEnabled;
    /**
     * @var bool
     */
    public $CalendarSyncEnabled;
    /**
     * @var string
     */
    public $DeviceAccountEmail;
    /**
     * @var string
     */
    public $ExchangeServer;
    /**
     * @var string
     */
    public $SessionInitiationProtocalAddress;
}