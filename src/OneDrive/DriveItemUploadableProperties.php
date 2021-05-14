<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class DriveItemUploadableProperties extends ClientValue
{
    /**
     * @var string
     */
    public $Description;
    /**
     * @var FileSystemInfo
     */
    public $FileSystemInfo;
    /**
     * @var string
     */
    public $Name;
}