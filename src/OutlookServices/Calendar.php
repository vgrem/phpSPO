<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OutlookServices;

use DateTime;
use Office365\Entity;
use Office365\EntityCollection;
use Office365\Runtime\Actions\ReadEntityQuery;
use Office365\Runtime\ResourcePath;

/**
 *  "A calendar which is a container for events. It can be a calendar for a user, or the default calendar of an Office 365 group."
 */
class Calendar extends Entity
{

    /**
     * @param \DateTime $startDateTime
     * @param \DateTime $endDateTime
     * @return EntityCollection
     */
    public function getCalendarView($startDateTime, $endDateTime)
    {
        $url = "CalendarView?startDateTime=" . rawurlencode($startDateTime->format(DateTime::ISO8601)) . "&endDateTime=" . rawurlencode($endDateTime->format(DateTime::W3C));
        $events = new EntityCollection($this->getContext(), new ResourcePath($url, $this->getResourcePath()),Event::class);
        $qry = new ReadEntityQuery($events);
        $this->getContext()->addQueryAndResultObject($qry, $events);
        return $events;
    }

    /**
     * The calendar name.
     * @return string
     */
    public function getName()
    {
        return $this->getProperty("Name");
    }
    /**
     * The calendar name.
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * Identifies the version of the calendar object. Every time the calendar is changed, changeKey changes as well. This allows Exchange to apply changes to the correct version of the object. Read-only.
     * @return string
     */
    public function getChangeKey()
    {
        return $this->getProperty("ChangeKey");
    }
    /**
     * Identifies the version of the calendar object. Every time the calendar is changed, changeKey changes as well. This allows Exchange to apply changes to the correct version of the object. Read-only.
     * @var string
     */
    public function setChangeKey($value)
    {
        $this->setProperty("ChangeKey", $value, true);
    }
    /**
     * @return bool
     */
    public function getCanShare()
    {
        return $this->getProperty("CanShare");
    }
    /**
     * @var bool
     */
    public function setCanShare($value)
    {
        $this->setProperty("CanShare", $value, true);
    }
    /**
     * @return bool
     */
    public function getCanViewPrivateItems()
    {
        return $this->getProperty("CanViewPrivateItems");
    }
    /**
     * @var bool
     */
    public function setCanViewPrivateItems($value)
    {
        $this->setProperty("CanViewPrivateItems", $value, true);
    }
    /**
     * @return bool
     */
    public function getCanEdit()
    {
        return $this->getProperty("CanEdit");
    }
    /**
     * @var bool
     */
    public function setCanEdit($value)
    {
        $this->setProperty("CanEdit", $value, true);
    }
    /**
     * @return EmailAddress
     */
    public function getOwner()
    {
        return $this->getProperty("Owner", new EmailAddress());
    }
    /**
     * @var EmailAddress
     */
    public function setOwner($value)
    {
        $this->setProperty("Owner", $value, true);
    }
    /**
     * Indicates whether this user calendar supports tracking of meeting responses. Only meeting invites sent from users' primary calendars support tracking of meeting responses.
     * @return bool
     */
    public function getIsTallyingResponses()
    {
        return $this->getProperty("IsTallyingResponses");
    }
    /**
     * Indicates whether this user calendar supports tracking of meeting responses. Only meeting invites sent from users' primary calendars support tracking of meeting responses.
     * @var bool
     */
    public function setIsTallyingResponses($value)
    {
        $this->setProperty("IsTallyingResponses", $value, true);
    }
    /**
     *  Indicates whether this user calendar can be deleted from the user mailbox.
     * @return bool
     */
    public function getIsRemovable()
    {
        return $this->getProperty("IsRemovable");
    }
    /**
     *  Indicates whether this user calendar can be deleted from the user mailbox.
     * @var bool
     */
    public function setIsRemovable($value)
    {
        $this->setProperty("IsRemovable", $value, true);
    }
}