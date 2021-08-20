<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Directory\Security;

use Office365\Runtime\ClientValue;
class ControlScore extends ClientValue
{
    /**
     * @var string
     */
    public $ControlCategory;
    /**
     * @var string
     */
    public $ControlName;
    /**
     * @var string
     */
    public $Description;
    /**
     * @var double
     */
    public $Score;
}