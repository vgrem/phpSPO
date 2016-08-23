<?php


use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\SharePoint\ListCreationInformation;
use Office365\PHP\Client\SharePoint\SPList;

class TestUtilities
{
    
    
    public static function createUniqueName($prefix){
        return  $prefix . "_" . rand(1, 100000);
    }


    /**
     * Based on example provided in this answer http://sharepoint.stackexchange.com/a/115211/10610
     * @param SPList $pagesList
     * @param string $pageName
     * @param string $pageContent
     * @return \Office365\PHP\Client\SharePoint\File
     */
    public static function createWikiPage(SPList $pagesList, $pageName, $pageContent)
    {
        /*static $templateRedirectionPageMarkup = "<%@ Page Inherits=\"Microsoft.SharePoint.Publishing.TemplateRedirectionPage,Microsoft.SharePoint.Publishing,Version=14.0.0.0,Culture=neutral,PublicKeyToken=71e9bce111e9429c\" %> <%@ Reference VirtualPath=\"~TemplatePageUrl\" %> <%@ Reference VirtualPath=\"~masterurl/custom.master\" %>";
        $pageInfo = new FileCreationInformation();
        $pageInfo->Url = $pageName;
        $pageInfo->Content = $templateRedirectionPageMarkup;
        $pageInfo->Overwrite = true;


        $ctx = $pagesList->getContext();
        $wikiFile = $pagesList->getRootFolder()->getFiles()->add($pageInfo);
        $ctx->executeQuery();
    
        $wikiItem = $wikiFile->getListItemAllFields();
        $wikiItem->setProperty("PublishingPageContent", $pageContent);
        //$wikiItem->setProperty("PublishingPageLayout", "/sites/news/_catalogs/masterpage/EnterpriseWiki.aspx, Basic Page");
        $wikiItem->update();
        $ctx->executeQuery();
        return $wikiFile;*/

        $ctx = $pagesList->getContext();
        $listFolder = $pagesList->getRootFolder();
        if(!$listFolder->isPropertyAvailable("ServerRelativeUrl")) {
            $ctx->load($listFolder);
            $ctx->executeQuery();
        }

        $fileUrl = $listFolder->getProperty("ServerRelativeUrl") . "/" . $pageName;
        $file = $listFolder->getFiles()->addTemplateFile($fileUrl, \Office365\PHP\Client\SharePoint\TemplateFileType::WikiPage);
        $ctx->executeQuery();
        return $file;
    }


    public static function createWeb(Office365\PHP\Client\SharePoint\ClientContext $ctx, $webUrl)
    {
        $web = $ctx->getWeb();
        $info = new \Office365\PHP\Client\SharePoint\WebCreationInformation($webUrl,$webUrl);
        $web = $web->getWebs()->add($info);
        $ctx->executeQuery();
        return $web;
    }
    
    
    
    public static function ensureList(Office365\PHP\Client\SharePoint\ClientContext $ctx, $listTitle, $type, $clearItems = true)
    {
        $lists = $ctx->getWeb()->getLists()->filter("Title eq '$listTitle'")->top(1);
        $ctx->load($lists);
        $ctx->executeQuery();
        if ($lists->getCount() == 1) {
            $existingList = $lists->getData()[0];
            if ($clearItems) {
                //self::deleteListItems($existingList);
            }
            return $existingList;
        }
        return TestUtilities::createList($ctx, $listTitle, $type);
    }



    public static function deleteListItems(\Office365\PHP\Client\SharePoint\SPList $list){
        $ctx = $list->getContext();
        $items = $list->getItems(\Office365\PHP\Client\SharePoint\CamlQuery::createAllItemsQuery());
        $ctx->load($items);
        $ctx->load($list);
        $ctx->executeQuery();
        
        $itemsCount = $list->getProperty('ItemCount');
        if ($itemsCount > 0) {
           self::deleteListItems($list);
        }
    }


    /**
     * @param ClientRuntimeContext $ctx
     * @param $listTitle
     * @param $type
     * @return \Office365\PHP\Client\SharePoint\SPList
     */
    public static function createList(ClientContext $ctx, $listTitle, $type){
        $info = new ListCreationInformation($listTitle);
        $info->BaseTemplate = $type;
        $list = $ctx->getWeb()->getLists()->add($info);
        $ctx->executeQuery();
        return $list;
    }


    /**
     * @param \Office365\PHP\Client\SharePoint\SPList $list
     */
    public static function deleteList(\Office365\PHP\Client\SharePoint\SPList $list){
        $ctx = $list->getContext();
        $list->deleteObject();
        $ctx->executeQuery();
    }


    /**
     * Create list item operation
     * @param \Office365\PHP\Client\SharePoint\SPList $list
     * @param array $itemProperties
     * @return \Office365\PHP\Client\SharePoint\ListItem
     */
    public static function createListItem(\Office365\PHP\Client\SharePoint\SPList $list, array $itemProperties){
        $ctx = $list->getContext();
        $item = $list->addItem($itemProperties);
        $ctx->executeQuery();
        return $item;
    }

}