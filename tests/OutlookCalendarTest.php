<?php

use Office365\PHP\Client\OutlookServices\Attendee;
use Office365\PHP\Client\OutlookServices\BodyType;
use Office365\PHP\Client\OutlookServices\EmailAddress;
use Office365\PHP\Client\OutlookServices\Event;
use Office365\PHP\Client\OutlookServices\ItemBody;
use Office365\PHP\Client\OutlookServices\Location;


require_once('OutlookServicesTestCase.php');


class OutlookCalendarTest extends OutlookServicesTestCase
{

    public function testCreateEvent(){

        $currentUser = self::$context->getMe();
        self::$context->load($currentUser);
        self::$context->executeQuery();

        $event = self::$context->getMe()->getEvents()->createEvent();
        $event->Subject = "--event--";
        $event->Body = new ItemBody(BodyType::Text,"--Content goes here--");
        $event->Attendees[] = new Attendee(new EmailAddress($currentUser->getProperty("DisplayName"),$currentUser->getProperty("Id")));
        self::$context->executeQuery();
        return $event;
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
        self::assertNotNull(1,$foundEvent);
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
