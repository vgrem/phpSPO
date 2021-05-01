<?php

namespace Office365;

use Office365\SharePoint\TenantSettings;

class TenantTest extends SharePointTestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
    }


    public function testGetSettings()
    {
        $settings = TenantSettings::getCurrent(self::$context)->executeQuery();
        $this->assertNotNull($settings);
    }




}
