<?php

use Office365\PHP\Client\OutlookServices\Attendee;
use Office365\PHP\Client\OutlookServices\BodyType;
use Office365\PHP\Client\OutlookServices\EmailAddress;
use Office365\PHP\Client\OutlookServices\Event;
use Office365\PHP\Client\OutlookServices\ItemBody;
use Office365\PHP\Client\OutlookServices\Location;


require_once('OutlookServicesTestCase.php');


class OutlookCommonTest extends OutlookServicesTestCase
{

    public function testGetCalendars(){
        $calendars = self::$context->getMe()->getCalendars();
        self::$context->load($calendars);
        self::$context->executeQuery();
    }






}
