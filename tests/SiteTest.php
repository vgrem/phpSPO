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
        $this->assertNotNull($site->getProperty("Url"),"Site resource could not be loaded");
    }


    public function testIfCustomActionsLoaded()
    {
        $actions = self::$context->getSite()->getUserCustomActions();
        self::$context->load($actions);
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(0,$actions->getCount());
    }

    public function testIfWebsLoaded()
    {
        $webs = self::$context->getSite()->getRootWeb()->getWebs();
        self::$context->load($webs);
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(0,$webs->getCount());
    }

}
