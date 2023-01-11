<?php

namespace Office365;

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

}
