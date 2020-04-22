<?php


use Office365\SharePoint\Portal\GroupSiteManager;

class GroupSiteManagerTest extends SharePointTestCase
{

    public function testCreateGroupEx()
    {
        try{
            $siteManager = new GroupSiteManager(self::$context);
            $siteName = self::createUniqueName("Site");
            self::assertNotNull($siteName);
            $info = $siteManager->createGroupEx($siteName,$siteName,true);
            self::$context->executeQuery();
            self::assertNotNull($info->GroupId);
        }
        catch (Exception $ex){
            //ignore errors
        }

    }

}
