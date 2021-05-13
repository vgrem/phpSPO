<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class ResultInfo extends ClientValue
{
    /**
     * @var integer
     */
    public $Code;
    /**
     * @var integer
     */
    public $Subcode;
    /**
     * @var string
     */
    public $Message;
}