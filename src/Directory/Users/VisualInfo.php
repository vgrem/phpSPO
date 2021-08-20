<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Directory\Users;

use Office365\OneDrive\Workbooks\Json;
use Office365\Runtime\ClientValue;
class VisualInfo extends ClientValue
{
    /**
     * @var string
     */
    public $BackgroundColor;
    /**
     * @var string
     */
    public $Description;
    /**
     * @var string
     */
    public $DisplayText;
    /**
     * @var Json
     */
    public $Content;
    /**
     * @var ImageInfo
     */
    public $Attribution;
}