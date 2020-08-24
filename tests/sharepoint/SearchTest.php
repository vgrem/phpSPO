<?php

namespace Office365;

use Office365\SharePoint\Search\SearchRequest;
use Office365\SharePoint\Search\SearchService;

class SearchTest extends SharePointTestCase
{

    public function testIfSiteLoaded()
    {
        $request = new SearchRequest();
        $request->Querytext = "guide.docx";
        $searchService = new SearchService(self::$context);
        $result = $searchService->postQuery($request);
        $searchService->executeQuery();
        $this->assertNotNull($result->{"PrimaryQueryResult"});
    }

}
