<?php

use Office365\PHP\Client\OutlookServices\Attendee;
use Office365\PHP\Client\OutlookServices\BodyType;
use Office365\PHP\Client\OutlookServices\EmailAddress;
use Office365\PHP\Client\OutlookServices\Event;
use Office365\PHP\Client\OutlookServices\ItemBody;
use Office365\PHP\Client\OutlookServices\Location;
use Office365\PHP\Client\OutlookServices\PhysicalAddress;




class OutlookCalendarTest extends OutlookServicesTestCase
{

    public function testCreateEvent()
    {
        $events = self::$context->getMe()->getEvents();
        self::$context->load($events);
        self::$context->executeQuery();

        $currentUser = self::$context->getMe();
        self::$context->load($currentUser);
        self::$context->executeQuery();

        $event = self::$context->getMe()->getEvents()->createEvent();
        $event->Subject = "--event--";
        $event->Body = new ItemBody(BodyType::Text,"--content goes here--");
        $event->Location = new Location();
        $event->Location->Address = new PhysicalAddress();
        $event->Location->Address->City = "Helsinki";
        $event->Location->Address->CountryOrRegion = "Finland";
        $event->Attendees[] = new Attendee(new EmailAddress($currentUser->getProperty("DisplayName"),$currentUser->getProperty("Id")));
        self::$context->executeQuery();

        $key = $event->getProperty("Id");
        $result = self::$context->getMe()->getEvents();
        self::$context->load($result);
        self::$context->executeQuery();
        $filteredResult = $result->findItems(
            function (Event $event) use ($key) {
                return  $event->getProperty("Id") === $key;
            });
        self:self::assertCount(1,$filteredResult);
        return $event;
    }



    public function testGetCalendarView(){
        $endDateTime = (new DateTime("now",new DateTimeZone("UTC")))->add(new DateInterval('P1D'));
        $startDateTime = (new DateTime("now",new DateTimeZone("UTC")))->sub(new DateInterval('P14D'));
        $events = self::$context->getMe()->getCalendar()->getCalendarView($startDateTime,$endDateTime);
        self::$context->load($events);
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(1,$events->getCount());
    }


    /**
     * @depends testCreateEvent
     * @param Event $event
     */
    public function testUpdateEvent(Event $event)
    {
        $location = new Location();
        $location->DisplayName = "Room A";
        $event->Location = $location;
        $event->update();
        self::$context->executeQuery();

        self::$context->load($event);
        self::$context->executeQuery();
        self::assertNotNull($event->getProperty("Location"));
    }


    /**
     * @depends testCreateEvent
     * @param Event $event
     */
    public function testGetEvents(Event $event){
        $events = self::$context->getMe()->getEvents();
        self::$context->load($events);
        self::$context->executeQuery();
        $foundEvent = $events->getItemById($event->getProperty("Id"));
        self::assertNotEmpty($foundEvent->getProperty("Id"));
    }



    /**
     * @depends testCreateEvent
     * @param Event $event
     */
    public function testDeleteEvent(Event $event)
    {
        $event->deleteObject();
        self::$context->executeQuery();

        $events = self::$context->getMe()->getEvents();
        self::$context->load($events);
        self::$context->executeQuery();
        $deletedEvent = $events->getItemById($event->getProperty("Id"));
        self::assertNull($deletedEvent);
    }






}
