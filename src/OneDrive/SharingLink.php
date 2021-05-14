<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\Identity;
use Office365\Runtime\ClientValue;
class SharingLink extends ClientValue
{
    /**
     * @var Identity
     */
    public $Application;
    /**
     * @var string
     */
    public $Scope;
    /**
     * @var string
     */
    public $Type;
    /**
     * @var string
     */
    public $WebUrl;
    /**
     * @var bool
     */
    public $PreventsDownload;
    /**
     * @var string
     */
    public $WebHtml;
}