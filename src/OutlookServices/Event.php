<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\OutlookServices;


use Office365\Entity;
use Office365\Common\DateTimeTimeZone;
use Office365\Runtime\ClientValueCollection;
use Office365\Runtime\ResourcePath;
/**
 *  "An event in a calendar."
 */
class Event extends Entity
{
    /**
     * The start time zone that was set when the event was created. A value of `tzone://Microsoft/Custom` indicates that a legacy custom time zone was set in desktop Outlook.
     * @return string
     */
    public function getOriginalStartTimeZone()
    {
        return $this->getProperty("OriginalStartTimeZone");
    }

    /**
     * The start time zone that was set when the event was created. A value of `tzone://Microsoft/Custom` indicates that a legacy custom time zone was set in desktop Outlook.
     *
     * @return self
     * @var string
     */
    public function setOriginalStartTimeZone($value)
    {
        return $this->setProperty("OriginalStartTimeZone", $value, true);
    }

    /**
     * The end time zone that was set when the event was created. A value of `tzone://Microsoft/Custom` indicates that a legacy custom time zone was set in desktop Outlook.
     * @return string
     */
    public function getOriginalEndTimeZone()
    {
        return $this->getProperty("OriginalEndTimeZone");
    }

    /**
     * The end time zone that was set when the event was created. A value of `tzone://Microsoft/Custom` indicates that a legacy custom time zone was set in desktop Outlook.
     * @var string
     */
    public function setOriginalEndTimeZone($value)
    {
        $this->setProperty("OriginalEndTimeZone", $value, true);
    }

    /**
     * A unique identifier that is shared by all instances of an event across different calendars. Read-only.
     * @return string
     */
    public function getICalUId()
    {
        return $this->getProperty("ICalUId");
    }

    /**
     * A unique identifier that is shared by all instances of an event across different calendars. Read-only.
     * @var string
     */
    public function setICalUId($value)
    {
        $this->setProperty("ICalUId", $value, true);
    }

    /**
     * The number of minutes before the event start time that the reminder alert occurs.
     * @return integer
     */
    public function getReminderMinutesBeforeStart()
    {
        return $this->getProperty("ReminderMinutesBeforeStart");
    }

    /**
     * The number of minutes before the event start time that the reminder alert occurs.
     * @var integer
     */
    public function setReminderMinutesBeforeStart($value)
    {
        $this->setProperty("ReminderMinutesBeforeStart", $value, true);
    }

    /**
     * Set to true if an alert is set to remind the user of the event.
     * @return bool
     */
    public function getIsReminderOn()
    {
        return $this->getProperty("IsReminderOn");
    }

    /**
     * Set to true if an alert is set to remind the user of the event.
     * @var bool
     */
    public function setIsReminderOn($value)
    {
        $this->setProperty("IsReminderOn", $value, true);
    }

    /**
     * Set to true if the event has attachments.
     * @return bool
     */
    public function getHasAttachments()
    {
        return $this->getProperty("HasAttachments");
    }

    /**
     * Set to true if the event has attachments.
     * @var bool
     */
    public function setHasAttachments($value)
    {
        $this->setProperty("HasAttachments", $value, true);
    }

    /**
     * The text of the event's subject line.
     * @return string
     */
    public function getSubject()
    {
        return $this->getProperty("Subject");
    }

    /**
     * The text of the event's subject line.
     * @var string
     */
    public function setSubject($value)
    {
        $this->setProperty("Subject", $value, true);
    }

    /**
     * The preview of the message associated with the event. It is in text format.
     * @return string
     */
    public function getBodyPreview()
    {
        return $this->getProperty("BodyPreview");
    }

    /**
     * The preview of the message associated with the event. It is in text format.
     *
     * @return self
     * @var string
     */
    public function setBodyPreview($value)
    {
        return $this->setProperty("BodyPreview", $value, true);
    }

    /**
     * Set to true if the event lasts all day.
     * @return bool
     */
    public function getIsAllDay()
    {
        return $this->getProperty("IsAllDay");
    }

    /**
     * Set to true if the event lasts all day.
     * @var bool
     */
    public function setIsAllDay($value)
    {
        $this->setProperty("IsAllDay", $value, true);
    }

    /**
     * Set to true if the event has been canceled.
     * @return bool
     */
    public function getIsCancelled()
    {
        return $this->getProperty("IsCancelled");
    }

    /**
     * Set to true if the event has been canceled.
     * @var bool
     */
    public function setIsCancelled($value)
    {
        $this->setProperty("IsCancelled", $value, true);
    }

    /**
     * Set to true if the calendar owner (specified by the **owner** property of the [calendar](calendar.md)) is the organizer of the event (specified by the **organizer** property of the **event**). This also applies if a delegate organized the event on behalf of the owner.
     * @return bool
     */
    public function getIsOrganizer()
    {
        return $this->getProperty("IsOrganizer");
    }

    /**
     * Set to true if the calendar owner (specified by the **owner** property of the [calendar](calendar.md)) is the organizer of the event (specified by the **organizer** property of the **event**). This also applies if a delegate organized the event on behalf of the owner.
     * @var bool
     */
    public function setIsOrganizer($value)
    {
        $this->setProperty("IsOrganizer", $value, true);
    }

    /**
     * Set to true if the sender would like a response when the event is accepted or declined.
     * @return bool
     */
    public function getResponseRequested()
    {
        return $this->getProperty("ResponseRequested");
    }

    /**
     * Set to true if the sender would like a response when the event is accepted or declined.
     * @var bool
     */
    public function setResponseRequested($value)
    {
        $this->setProperty("ResponseRequested", $value, true);
    }

    /**
     * The ID for the recurring series master item, if this event is part of a recurring series.
     * @return string
     */
    public function getSeriesMasterId()
    {
        return $this->getProperty("SeriesMasterId");
    }

    /**
     * The ID for the recurring series master item, if this event is part of a recurring series.
     * @var string
     */
    public function setSeriesMasterId($value)
    {
        $this->setProperty("SeriesMasterId", $value, true);
    }

    /**
     * The organizer of the event.
     * @return Recipient
     */
    public function getOrganizer()
    {
        return $this->getProperty("Organizer", new Recipient());
    }

    /**
     * The organizer of the event.
     * @var Recipient
     */
    public function setOrganizer($value)
    {
        $this->setProperty("Organizer", $value, true);
    }

    /**
     * The URL to open the event in Outlook on the web.<br/><br/>Outlook on the web opens the event in the browser if you are signed in to your mailbox. Otherwise, Outlook on the web prompts you to sign in.<br/><br/>This URL can be accessed from within an iFrame.
     * @return string
     */
    public function getWebLink()
    {
        return $this->getProperty("WebLink");
    }

    /**
     * The URL to open the event in Outlook on the web.<br/><br/>Outlook on the web opens the event in the browser if you are signed in to your mailbox. Otherwise, Outlook on the web prompts you to sign in.<br/><br/>This URL can be accessed from within an iFrame.
     * @var string
     */
    public function setWebLink($value)
    {
        $this->setProperty("WebLink", $value, true);
    }

    /**
     * A URL for an online meeting. The property is set only when an organizer specifies an event as an online meeting such as a Skype meeting. Read-only.
     * @return string
     */
    public function getOnlineMeetingUrl()
    {
        return $this->getProperty("OnlineMeetingUrl");
    }

    /**
     * A URL for an online meeting. The property is set only when an organizer specifies an event as an online meeting such as a Skype meeting. Read-only.
     * @var string
     */
    public function setOnlineMeetingUrl($value)
    {
        $this->setProperty("OnlineMeetingUrl", $value, true);
    }

    /**
     * The date, time, and time zone that the event starts. By default, the start time is in UTC.
     * @return DateTimeTimeZone
     */
    public function getStart()
    {
        return $this->getProperty("Start", new DateTimeTimeZone());
    }

    /**
     * The date, time, and time zone that the event starts. By default, the start time is in UTC.
     *
     * @return self
     * @var DateTimeTimeZone
     */
    public function setStart($value)
    {
        return $this->setProperty("Start", $value, true);
    }

    /**
     * The date, time, and time zone that the event ends. By default, the end time is in UTC.
     * @return DateTimeTimeZone
     */
    public function getEnd()
    {
        return $this->getProperty("End", new DateTimeTimeZone());
    }

    /**
     * The date, time, and time zone that the event ends. By default, the end time is in UTC.
     * @var DateTimeTimeZone
     */
    public function setEnd($value)
    {
        $this->setProperty("End", $value, true);
    }

    /**
     * The calendar that contains the event. Navigation property. Read-only.
     * @return Calendar
     */
    public function getCalendar()
    {
        return $this->getProperty("Calendar",
            new Calendar($this->getContext(), new ResourcePath("Calendar", $this->getResourcePath())));
    }

    /**
     * Indicates the type of response sent in response to an event message.
     * @return ResponseStatus
     */
    public function getResponseStatus()
    {
        return $this->getProperty("ResponseStatus", new ResponseStatus());
    }

    /**
     * Indicates the type of response sent in response to an event message.
     * @var ResponseStatus
     */
    public function setResponseStatus($value)
    {
        $this->setProperty("ResponseStatus", $value, true);
    }

    /**
     * The body of the message associated with the event. It can be in HTML or text format.
     * @return ItemBody
     */
    public function getBody()
    {
        return $this->getProperty("Body", new ItemBody());
    }

    /**
     * The body of the message associated with the event. It can be in HTML or text format.
     * @var ItemBody
     */
    public function setBody($value)
    {
        $this->setProperty("Body", $value, true);
    }

    /**
     * The location of the event.
     * @return Location
     */
    public function getLocation()
    {
        return $this->getProperty("Location", new Location());
    }

    /**
     * The location of the event.
     *
     * @return self
     * @var Location
     */
    public function setLocation($value)
    {
        return $this->setProperty("Location", $value);
    }

    /**
     * The recurrence pattern for the event.
     * @return PatternedRecurrence
     */
    public function getRecurrence()
    {
        return $this->getProperty("Recurrence", new PatternedRecurrence());
    }

    /**
     * The recurrence pattern for the event.
     * @var PatternedRecurrence
     */
    public function setRecurrence($value)
    {
        $this->setProperty("Recurrence", $value, true);
    }

    /**
     *  `True` if this event has online meeting information, `false` otherwise. Default is false. Optional.
     * @return bool
     */
    public function getIsOnlineMeeting()
    {
        return $this->getProperty("IsOnlineMeeting");
    }

    /**
     *  `True` if this event has online meeting information, `false` otherwise. Default is false. Optional.
     * @var bool
     */
    public function setIsOnlineMeeting($value)
    {
        $this->setProperty("IsOnlineMeeting", $value, true);
    }

    /**
     * @return bool
     */
    public function getAllowNewTimeProposals()
    {
        return $this->getProperty("AllowNewTimeProposals");
    }

    /**
     * @var bool
     */
    public function setAllowNewTimeProposals($value)
    {
        $this->setProperty("AllowNewTimeProposals", $value, true);
    }


    /**
     * @return ClientValueCollection
     */
    public function getAttendees()
    {
        return $this->getProperty("Attendees", new ClientValueCollection(Attendee::class));
    }


    /**
     * @param EmailAddress[]|Attendee[] $values
     */
    public function setAttendees($values)
    {
        $values = array_map(function ($value) {
            if ($value instanceof EmailAddress)
                return new Attendee($value);
            else
                return $value;
        }, $values);
        return $this->setProperty("Attendees", ClientValueCollection::fromArray(Attendee::class,$values));
    }

}