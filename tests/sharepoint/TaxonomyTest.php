<?php

namespace Office365;

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\Taxonomy\TaxonomyService;
use Office365\SharePoint\Taxonomy\TermGroup;


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

    public function testGetTermStore()
    {
        $ts = self::$taxSvc->getTermStore()->get()->executeQuery();
        $this->assertNotNull($ts->getResourcePath());
    }

    public function testListTermGroups()
    {
        $ts = self::$taxSvc->getTermStore();
        $groups = $ts->getTermGroups()->get()->executeQuery();
        $this->assertNotNull($groups->getResourcePath());
        $returnGroup = $groups->findFirst("name","Geography");
        $this->assertNotNull($returnGroup->getResourcePath());
        return $returnGroup;
    }

    /**
     * @depends testListTermGroups
     * @param TermGroup $targetGroup
     */
    public function testListTermSets($targetGroup)
    {
        $termSets = $targetGroup->getTermSets()->get()->executeQuery();
        $this->assertNotNull($termSets->getResourcePath());
    }
}
