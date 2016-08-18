<?php


use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientRuntimeContext;
use SharePoint\PHP\Client\ListCreationInformation;
use SharePoint\PHP\Client\SPList;

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
     * @return \SharePoint\PHP\Client\File
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
        $file = $listFolder->getFiles()->addTemplateFile($fileUrl,\SharePoint\PHP\Client\TemplateFileType::WikiPage);
        $ctx->executeQuery();
        return $file;
    }


    public static function createWeb(SharePoint\PHP\Client\ClientContext $ctx, $webUrl)
    {
        $web = $ctx->getWeb();
        $info = new \SharePoint\PHP\Client\WebCreationInformation($webUrl,$webUrl);
        $web = $web->getWebs()->add($info);
        $ctx->executeQuery();
        return $web;
    }
    
    
    
    public static function ensureList(SharePoint\PHP\Client\ClientContext $ctx, $listTitle, $type, $clearItems = true)
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



    public static function deleteListItems(\SharePoint\PHP\Client\SPList $list){
        $ctx = $list->getContext();
        $items = $list->getItems(\SharePoint\PHP\Client\CamlQuery::createAllItemsQuery());
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
     * @return \SharePoint\PHP\Client\SPList
     */
    public static function createList(ClientContext $ctx, $listTitle, $type){
        $info = new ListCreationInformation($listTitle);
        $info->BaseTemplate = $type;
        $list = $ctx->getWeb()->getLists()->add($info);
        $ctx->executeQuery();
        return $list;
    }


    /**
     * @param \SharePoint\PHP\Client\SPList $list
     */
    public static function deleteList(\SharePoint\PHP\Client\SPList $list){
        $ctx = $list->getContext();
        $list->deleteObject();
        $ctx->executeQuery();
    }


    /**
     * Create list item operation
     * @param \SharePoint\PHP\Client\SPList $list
     * @param array $itemProperties
     * @return \SharePoint\PHP\Client\ListItem
     */
    public static function createListItem(\SharePoint\PHP\Client\SPList $list, array $itemProperties){
        $ctx = $list->getContext();
        $item = $list->addItem($itemProperties);
        $ctx->executeQuery();
        return $item;
    }

}