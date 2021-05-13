<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class OmaSetting extends ClientValue
{
    /**
     * @var string
     */
    public $DisplayName;
    /**
     * @var string
     */
    public $Description;
    /**
     * @var string
     */
    public $OmaUri;
}