<?php


use Office365\PHP\Client\SharePoint\Search\Query\KeywordQuery;
use Office365\PHP\Client\SharePoint\Search\Query\SearchExecutor;

class SearchTest extends SharePointTestCase
{

    public function testIfSiteLoaded()
    {
        //Experimental!
        $keywordQuery = new KeywordQuery(self::$context);
        $keywordQuery->QueryText = "SharePoint";
        $searchExecutor = new SearchExecutor(self::$context);
        //$results = $searchExecutor->executeQuery($keywordQuery);
        self::$context->executeQuery();
        $this->assertNotNull($keywordQuery);
    }

}
