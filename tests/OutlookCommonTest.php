<?php

use Office365\PHP\Client\OutlookServices\Attendee;
use Office365\PHP\Client\OutlookServices\BodyType;
use Office365\PHP\Client\OutlookServices\EmailAddress;
use Office365\PHP\Client\OutlookServices\Event;
use Office365\PHP\Client\OutlookServices\ItemBody;
use Office365\PHP\Client\OutlookServices\Location;
use Office365\PHP\Client\Runtime\ClientObjectCollection;


require_once('OutlookServicesTestCase.php');


class OutlookCommonTest extends OutlookServicesTestCase
{

    public function testGetCalendars(){
        $calendars = self::$context->getMe()->getCalendars();
        self::$context->load($calendars);
        self::$context->executeQuery();
    }


    public function testDeleteAllEvents(){
        $events = self::$context->getMe()->getEvents();
        $this->deleteAllItems($events);
        self::$context->load($events);
        self::$context->executeQuery();
        self::assertEmpty($events->getCount());
    }

    /*public function testDeleteAllMessages(){
        $messages = self::$context->getMe()->getMessages();
        $this->deleteAllItems($messages);
        self::$context->load($messages);
        self::$context->executeQuery();
        self::assertEmpty($messages->getCount());
    }*/


    private function deleteAllItems(ClientObjectCollection $items){
        self::$context->load($items);
        self::$context->executeQuery();
        foreach ($items->getData() as $item){
            $item->deleteObject();
            self::$context->executeQuery();
        }
    }








}
