<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class Thumbnail extends ClientValue
{
    /**
     * @var integer
     */
    public $Height;
    /**
     * @var string
     */
    public $SourceItemId;
    /**
     * @var string
     */
    public $Url;
    /**
     * @var integer
     */
    public $Width;
}