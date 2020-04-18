<?php


namespace Office365\PHP\Client\SharePoint\Portal;

use SharePointTestCase;

class GroupSiteManagerTest extends SharePointTestCase
{

    public function testCreateGroupEx()
    {
        $siteManager = new GroupSiteManager(self::$context);
        $siteName = self::createUniqueName("Site");
        self::assertNotNull($siteName);
        //$info = $siteManager->createGroupEx($siteName,$siteName,true);
        //self::$context->executeQuery();
        //self::assertNotNull($info->GroupId);
    }

}
