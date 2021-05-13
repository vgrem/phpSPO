<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class RegistryKeyState extends ClientValue
{
    /**
     * @var string
     */
    public $Key;
    /**
     * @var string
     */
    public $OldKey;
    /**
     * @var string
     */
    public $OldValueData;
    /**
     * @var string
     */
    public $OldValueName;
    /**
     * @var integer
     */
    public $ProcessId;
    /**
     * @var string
     */
    public $ValueData;
    /**
     * @var string
     */
    public $ValueName;
}