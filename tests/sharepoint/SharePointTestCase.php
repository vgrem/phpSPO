<?php

namespace Office365;

use Exception;
use Office365\Runtime\Auth\UserCredentials;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;
use Office365\SharePoint\ListCreationInformation;
use Office365\SharePoint\ListItem;
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

    protected static $testLoginName = "i:0#.f|membership|mdoe@mediadev8.onmicrosoft.com";

    public static function setUpBeforeClass()
    {
        $settings = include(__DIR__ . '/../../Settings.php');
        self::$context = (new ClientContext($settings['Url']))
            ->withCredentials(new UserCredentials($settings['UserName'],$settings['Password']));
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
     * @internal param ClientRuntimeContext $ctx
     */
    public static function createList(Web $web, $listTitle, $type)
    {
        $ctx = $web->getContext();
        $info = new ListCreationInformation($listTitle);
        $info->BaseTemplate = $type;
        $list = $web->getLists()->add($info);
        $ctx->executeQuery();
        return $list;
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
            $items[] = self::createListItem($targetList, $itemProperties);
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
        $file = $listFolder->getFiles()->addTemplateFile($fileUrl, TemplateFileType::WikiPage);
        $ctx->executeQuery();
        return $file;
    }


    /**
     * Create list item operation
     * @param SPList $list
     * @param array $itemProperties
     * @return ListItem
     * @throws Exception
     */
    public static function createListItem(SPList $list, array $itemProperties){
        $ctx = $list->getContext();
        $item = $list->addItem($itemProperties);
        $ctx->executeQuery();
        return $item;
    }

}
