<?php

namespace Office365;

use DateTime;
use Office365\SharePoint\Search\SearchRequest;
use Office365\SharePoint\Search\SearchResult;

class SearchTest extends SharePointTestCase
{

    public function testPostQuery()
    {
        $request = new SearchRequest();
        $request->Querytext = "guide.docx";
        $result = self::$context->getSearch()->postQuery($request)->executeQuery();
        $this->assertInstanceOf(SearchResult::class, $result->getValue());
    }

    public function testExport()
    {
        $startTime = new DateTime('now -6 month');
        $me = self::$context->getWeb()->getCurrentUser();
        $result = self::$context->getSearch()->export($me, $startTime)->executeQuery();
        $this->assertNotNull($result->getValue());
    }

}
