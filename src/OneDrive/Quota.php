<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class Quota extends ClientValue
{
    /**
     * @var integer
     */
    public $Deleted;
    /**
     * @var integer
     */
    public $Remaining;
    /**
     * @var string
     */
    public $State;
    /**
     * @var integer
     */
    public $Total;
    /**
     * @var integer
     */
    public $Used;
}