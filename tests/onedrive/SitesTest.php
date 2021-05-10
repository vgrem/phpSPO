<?php

namespace Office365;

class SitesTest extends GraphTestCase
{


    public function testListSites()
    {
        $sites = self::$graphClient->getSites()->get()->executeQuery();
        self::assertNotNull($sites->getResourcePath());
    }

}