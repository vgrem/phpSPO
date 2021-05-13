<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class SecurityVendorInformation extends ClientValue
{
    /**
     * @var string
     */
    public $Provider;
    /**
     * @var string
     */
    public $ProviderVersion;
    /**
     * @var string
     */
    public $SubProvider;
    /**
     * @var string
     */
    public $Vendor;
}