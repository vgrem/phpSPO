<?php

namespace Office365;

use Office365\SharePoint\TenantSettings;

class TenantTest extends SharePointTestCase
{

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }


    public function testGetSettings()
    {
        $settings = TenantSettings::getCurrent(self::$context)->executeQuery();
        $this->assertNotNull($settings);
    }




}
