<?php

namespace Office365;

use Office365\SharePoint\Portal\SPSiteCreationResponse;

class SPSiteManagerTest extends SharePointTestCase
{
    /**
     * @var string
     */
    private static $targetSiteId;

    public function testCreateCommunicationSite()
    {
        $siteName = self::createUniqueName("CommSite");
        self::assertNotNull($siteName);
        $result = self::$context->getSiteManager()->create($siteName,
            self::$settings["UserName"],
            "Low Business Impact")->executeQuery();
        self::assertInstanceOf(SPSiteCreationResponse::class, $result->getValue());
        self::$targetSiteId = $result->getValue()->SiteId;
    }

    public function testDeleteCommunicationSite()
    {
        self::$context->getSiteManager()->delete(self::$targetSiteId)->executeQuery();
    }

}
