<?php

/**
 * Modified: 2020-05-24T22:02:06+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientValue;
class OnPremisesProvisioningError extends ClientValue
{
    /**
     * @var string
     */
    public $Value;
    /**
     * @var string
     */
    public $Category;
    /**
     * @var string
     */
    public $PropertyCausingError;
}