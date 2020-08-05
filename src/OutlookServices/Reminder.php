<?php


namespace Office365\OutlookServices;


use Office365\Runtime\ClientValue;

/**
 * Class Reminder
 * @package Office365\Outlook
 */
class Reminder extends ClientValue
{

    /**
     * @var string $EventId
     */
    public $EventId;


    /**
     * @var DateTimeTimeZone $EventStartTime
     */
    public $EventStartTime;


    /**
     * @var DateTimeTimeZone $EventEndTime
     */
    public $EventEndTime;


    /**
     * @var string $ChangeKey
     */
    public $ChangeKey;


    /**
     * @var string $EventSubject
     */
    public $EventSubject;


    /**
     * @var Location $EventLocation
     */
    public $EventLocation;


    /**
     * @var string $EventWebLink
     */
    public $EventWebLink;


    /**
     * @var DateTimeTimeZone $ReminderFireTime
     */
    public $ReminderFireTime;

}