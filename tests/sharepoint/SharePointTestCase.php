<?php

namespace Office365;

use Exception;
use Office365\Runtime\Auth\UserCredentials;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;
use Office365\SharePoint\ListCreationInformation;
use Office365\SharePoint\SPList;
use Office365\SharePoint\TemplateFileType;
use Office365\SharePoint\Web;
use PHPUnit\Framework\TestCase;


abstract class SharePointTestCase extends TestCase
{
    /**
     * @var ClientContext
     */
    protected static $context;

    protected static $testAccountName;

    protected  static $settings;

    public static function setUpBeforeClass()
    {
        self::$settings = include(__DIR__ . '/../Settings.php');
        self::$testAccountName = self::$settings['TestAccountName'];
        self::$context = (new ClientContext(self::$settings['Url']))
            ->withCredentials(new UserCredentials(self::$settings['UserName'],self::$settings['Password']));
    }

    public static function tearDownAfterClass()
    {
        self::$context = null;
    }


    /**
     * @param Web $web
     * @param string $listTitle
     * @param int $type
     * @return SPList
     */
    public static function ensureList(Web $web, $listTitle, $type)
    {
        $lists = $web->getLists()->filter("Title eq '$listTitle'")
            ->top(1)
            ->get()
            ->executeQuery();
        if ($lists->getCount() == 1) {
            return $lists->getData()[0];
        }
        return self::createList($web, $listTitle, $type);
    }


    /**
     * @param Web $web
     * @param $listTitle
     * @param $type
     * @return SPList
     */
    public static function createList(Web $web, $listTitle, $type)
    {
        $info = new ListCreationInformation($listTitle);
        $info->BaseTemplate = $type;
        return $web->getLists()->add($info)->executeQuery();
    }

    public static function createUniqueName($prefix){
        return  $prefix . "_" . rand(1, 100000);
    }

    /**
     * Populate List
     * @param $targetList SPList
     * @param $itemProperties array
     * @param $itemsCount integer
     * @return array
     * @throws Exception
     */
    public static function populateList($targetList,$itemProperties,$itemsCount)
    {
        $items = [];
        $idx = 0;
        while($idx < $itemsCount){
            $items[] = $targetList->addItem($itemProperties)->executeQuery();
            $idx++;
        }
        return $items;
    }


    /**
     * Based on example provided in this answer http://sharepoint.stackexchange.com/a/115211/10610
     * @param SPList $pagesList
     * @param string $pageName
     * @return File
     */
    public static function createWikiPage(SPList $pagesList, $pageName)
    {
        $ctx = $pagesList->getContext();
        $listFolder = $pagesList->getRootFolder();
        if(!$listFolder->isPropertyAvailable("ServerRelativeUrl")) {
            $ctx->load($listFolder);
            $ctx->executeQuery();
        }

        $fileUrl = $listFolder->getProperty("ServerRelativeUrl") . "/" . $pageName;
        return $listFolder->getFiles()->addTemplateFile($fileUrl, TemplateFileType::WikiPage)->executeQuery();
    }
}
