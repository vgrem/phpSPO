<?php

/**
 * Modified: 2020-05-24T22:06:36+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Common\AutomaticRepliesSetting;
use Office365\Common\LocaleInfo;
use Office365\Runtime\ClientValue;
/**
 *  "Settings for the primary mailbox of the signed-in user."
 */
class MailboxSettings extends ClientValue
{
    /**
     * Folder ID of an archive folder for the user.
     * @var string
     */
    public $ArchiveFolder;
    /**
     * The default time zone for the user's mailbox.
     * @var string
     */
    public $TimeZone;
    /**
     * The date format for the user's mailbox.
     * @var string
     */
    public $DateFormat;
    /**
     * The time format for the user's mailbox.
     * @var string
     */
    public $TimeFormat;
    /**
     * Configuration settings to automatically notify the sender of an incoming email with a message from the signed-in user.
     * @var AutomaticRepliesSetting
     */
    public $AutomaticRepliesSetting;
    /**
     * The locale information for the user, including the preferred language and country/region.
     * @var LocaleInfo
     */
    public $Language;
    /**
     * The days of the week and hours in a specific time zone that the user works.
     * @var WorkingHours
     */
    public $WorkingHours;
}