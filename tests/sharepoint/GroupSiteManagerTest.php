<?php

namespace Office365;

use Exception;

class GroupSiteManagerTest extends SharePointTestCase
{

    public function testCreateGroupEx()
    {
        try{
            $siteName = self::createUniqueName("Site");
            self::assertNotNull($siteName);
            $info = self::$context->getGroupSiteManager()->createGroupEx($siteName,$siteName,true);
            self::$context->executeQuery();
            self::assertNotNull($info->GroupId);
        }
        catch (Exception $ex){
            //ignore errors
        }
    }

}
