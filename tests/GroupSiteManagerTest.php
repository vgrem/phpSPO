<?php


namespace Office365\PHP\Client\SharePoint\Portal;

use SharePointTestCase;
use TestUtilities;

class GroupSiteManagerTest extends SharePointTestCase
{

    public function testCreateGroupEx()
    {
        $siteManager = new GroupSiteManager(self::$context);
        $siteName = TestUtilities::createUniqueName("Site");
        $info = $siteManager->createGroupEx($siteName,$siteName,true);
        self::$context->executeQuery();
        self::assertNotNull($info->SiteUrl);
    }

}
