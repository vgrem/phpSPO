<?php


namespace Office365\PHP\Client\SharePoint\Portal;

use SharePointTestCase;
use ListItemExtensions;

class GroupSiteManagerTest extends SharePointTestCase
{

    public function testCreateGroupEx()
    {
        $siteManager = new GroupSiteManager(self::$context);
        $siteName = ListItemExtensions::createUniqueName("Site");
        $info = $siteManager->createGroupEx($siteName,$siteName,true);
        self::$context->executeQuery();
        self::assertNotNull($info->GroupId);
    }

}
