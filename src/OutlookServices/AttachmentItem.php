<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class AttachmentItem extends ClientValue
{
    /**
     * @var string
     */
    public $Name;
    /**
     * @var integer
     */
    public $Size;
    /**
     * @var string
     */
    public $ContentType;
    /**
     * @var bool
     */
    public $IsInline;
}