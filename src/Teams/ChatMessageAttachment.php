<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class ChatMessageAttachment extends ClientValue
{
    /**
     * @var string
     */
    public $Id;
    /**
     * @var string
     */
    public $ContentType;
    /**
     * @var string
     */
    public $ContentUrl;
    /**
     * @var string
     */
    public $Content;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $ThumbnailUrl;
}