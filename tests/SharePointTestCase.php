<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\SharePoint\File;
use Office365\PHP\Client\SharePoint\ListCreationInformation;
use Office365\PHP\Client\SharePoint\ListItem;
use Office365\PHP\Client\SharePoint\SPList;
use Office365\PHP\Client\SharePoint\TemplateFileType;
use Office365\PHP\Client\SharePoint\Web;
use Office365\PHP\Client\SharePoint\WebCreationInformation;
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
        $settings = include(__DIR__ . '/../Settings.php');
        //self::$context = ClientContext::connectWithClientCredentials($settings['Url'],$settings['ClientId'],$settings['ClientSecret']);
        self::$context = ClientContext::connectWithUserCredentials($settings['Url'],$settings['UserName'],$settings['Password']);
    }

    public static function tearDownAfterClass()
    {
        self::$context = null;
    }


    /**
     * @param ClientContext $ctx
     * @param string $webUrl
     * @return Web
     */
    public static function createWeb(Office365\PHP\Client\SharePoint\ClientContext $ctx, $webUrl)
    {
        $web = $ctx->getWeb();
        $info = new WebCreationInformation($webUrl,$webUrl);
        $web = $web->getWebs()->add($info);
        $ctx->executeQuery();
        return $web;
    }


    public static function ensureList(Web $web, $listTitle, $type, $clearItems = true)
    {
        $ctx = $web->getContext();
        $lists = $web->getLists()->filter("Title eq '$listTitle'")->top(1);
        $ctx->load($lists);
        $ctx->executeQuery();
        if ($lists->getCount() == 1) {
            $existingList = $lists->getData()[0];
            if ($clearItems) {
                //self::deleteListItems($existingList);
            }
            return $existingList;
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


    /**
     * @param SPList $list
     */
    public static function deleteList(SPList $list){
        $ctx = $list->getContext();
        $list->deleteObject();
        $ctx->executeQuery();
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
     * @param string $pageContent
     * @return File
     */
    public static function createWikiPage(SPList $pagesList, $pageName, $pageContent)
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
