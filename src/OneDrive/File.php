<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\Hashes;
use Office365\Runtime\ClientValue;
class File extends ClientValue
{
    /**
     * @var string
     */
    public $MimeType;
    /**
     * @var bool
     */
    public $ProcessingMetadata;
    /**
     * @var Hashes
     */
    public $Hashes;
}