<?php

namespace Office365;

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\Taxonomy\TaxonomyService;


class TaxonomyTest extends SharePointTestCase
{

    /**
     * @var TaxonomyService
     */
    protected static $taxSvc;

    public static function setUpBeforeClass()
    {
        $settings = include(__DIR__ . '/../../Settings.php');
        $appCtx = (new ClientContext($settings['Url']))
            ->withCredentials(new ClientCredential($settings['ClientId'],$settings['ClientSecret']));
        self::$taxSvc = new TaxonomyService($appCtx);
        //parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass()
    {
        //parent::tearDownAfterClass();
    }


    public function testTermStore()
    {
        $ts = self::$taxSvc->getTermStore()->get()->executeQuery();
        $this->assertNotNull($ts->getResourcePath());
    }

}
