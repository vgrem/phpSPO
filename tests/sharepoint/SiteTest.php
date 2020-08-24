<?php

namespace Office365;

class SiteTest extends SharePointTestCase
{
    public function testIfSiteLoaded()
    {
        $site = self::$context->getSite()->get()->executeQuery();
        $this->assertNotNull($site->getUrl(),"Site resource could not be loaded");
    }

    public function testIfCustomActionsLoaded()
    {
        $actions = self::$context->getSite()->getUserCustomActions()->get()->executeQuery();
        self::assertGreaterThanOrEqual(0,$actions->getCount());
    }

    /*public function testIfWebsLoaded()
    {
        $webs = self::$context->getSite()->getRootWeb()->getWebs();
        self::$context->load($webs);
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(0,$webs->getCount());
    }*/

}
