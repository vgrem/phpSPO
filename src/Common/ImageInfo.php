<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class ImageInfo extends ClientValue
{
    /**
     * @var string
     */
    public $IconUrl;
    /**
     * @var string
     */
    public $AlternativeText;
    /**
     * @var string
     */
    public $AlternateText;
    /**
     * @var bool
     */
    public $AddImageQuery;
}