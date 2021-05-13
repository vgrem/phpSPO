<?php

namespace Office365;


class ApplicationsTest extends GraphTestCase
{

    public function testListApps()
    {
        $apps = self::$graphClient->getApplications()->get()->executeQuery();
        self::assertNotNull($apps->getResourcePath());
    }



}