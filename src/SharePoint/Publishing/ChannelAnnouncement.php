<?php

/**
 * Generated  2025-08-19T15:30:13+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientValue;
class ChannelAnnouncement extends ClientValue
{
    /**
     * @var string
     */
    public $ChannelName;
    /**
     * @var integer
     */
    public $ID;
    /**
     * @var bool
     */
    public $IsRead;
    /**
     * @var string
     */
    public $Message;
    /**
     * @var string
     */
    public $PublishStartDate;
    /**
     * @var string
     */
    public $Title;
    /**
     * @var AnnouncementAuthor
     */
    public $Author;
    /**
     * @var CallToAction
     */
    public $CallToAction;
    /**
     * @var Icon
     */
    public $Icon;
}