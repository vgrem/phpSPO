<?php

namespace Office365;


use Office365\Reports\Report;

class ReportsTest extends GraphTestCase
{

    public function testGetOffice365ActiveUserCounts()
    {
        $result = self::$graphClient->getReports()->getOffice365ActiveUserCounts("D180")->executeQuery();
        self::assertNotNull($result->getValue());
        self::assertInstanceOf(Report::class,$result->getValue());
    }

}