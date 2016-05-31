<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');


class SiteTest extends SharePointTestCase
{

    public function testIfSiteLoaded()
    {
        $site = self::$context->getSite();
        self::$context->load($site);
        self::$context->executeQuery();
        $this->assertNotNull($site,"Site resource could not be loaded");
    }

}
