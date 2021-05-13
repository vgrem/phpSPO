<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class Hashes extends ClientValue
{
    /**
     * @var string
     */
    public $Crc32Hash;
    /**
     * @var string
     */
    public $QuickXorHash;
    /**
     * @var string
     */
    public $Sha1Hash;
}