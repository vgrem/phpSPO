<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class FileSecurityState extends ClientValue
{
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $Path;
    /**
     * @var string
     */
    public $RiskScore;
    /**
     * @var FileHash
     */
    public $FileHash;
}