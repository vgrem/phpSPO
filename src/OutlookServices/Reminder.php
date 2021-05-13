<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\OutlookServices;

use Office365\Common\DateTimeTimeZone;
use Office365\Runtime\ClientValue;
class Reminder extends ClientValue
{
    /**
     * @var string
     */
    public $EventId;
    /**
     * @var DateTimeTimeZone
     */
    public $EventStartTime;
    /**
     * @var DateTimeTimeZone
     */
    public $EventEndTime;
    /**
     * @var string
     */
    public $ChangeKey;
    /**
     * @var string
     */
    public $EventSubject;
    /**
     * @var string
     */
    public $EventWebLink;
    /**
     * @var DateTimeTimeZone
     */
    public $ReminderFireTime;
    /**
     * @var Location
     */
    public $EventLocation;
}