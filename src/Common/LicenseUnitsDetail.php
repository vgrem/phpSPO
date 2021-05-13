<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class LicenseUnitsDetail extends ClientValue
{
    /**
     * @var integer
     */
    public $Enabled;
    /**
     * @var integer
     */
    public $Suspended;
    /**
     * @var integer
     */
    public $Warning;
}