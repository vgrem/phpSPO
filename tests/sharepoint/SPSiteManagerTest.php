<?php

namespace Office365;

use Office365\SharePoint\Portal\SPSiteCreationResponse;
use Office365\SharePoint\Portal\SPSiteManager;

class SPSiteManagerTest extends SharePointTestCase
{
    /**
     * @var string
     */
    private static $targetSiteId;

    public function testCreateCommunicationSite()
    {
        $siteManager = new SPSiteManager(self::$context);
        $siteName = self::createUniqueName("CommSite");
        self::assertNotNull($siteName);
        $result = $siteManager->create($siteName,self::$settings["UserName"],"Low Business Impact");
        self::$context->executeQuery();
        self::assertInstanceOf(SPSiteCreationResponse::class, $result->getValue());
        self::$targetSiteId = $result->getValue()->SiteId;
    }

    public function testDeleteCommunicationSite()
    {
        $siteManager = new SPSiteManager(self::$context);
        $siteManager->delete(self::$targetSiteId)->executeQuery();
    }

}
