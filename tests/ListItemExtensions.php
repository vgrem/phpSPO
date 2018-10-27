<?php


use Office365\PHP\Client\SharePoint\SPList;


class ListItemExtensions
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
        $pageInfo->content = $templateRedirectionPageMarkup;
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



    public static function ensureListItem(SPList $list, $itemId,$defaultProperties)
    {
        throw new Exception("Not implemented: ensureListItem");
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
     * Create list item operation
     * @param \Office365\PHP\Client\SharePoint\SPList $list
     * @param array $itemProperties
     * @return \Office365\PHP\Client\SharePoint\ListItem
     * @throws Exception
     */
    public static function createListItem(\Office365\PHP\Client\SharePoint\SPList $list, array $itemProperties){
        $ctx = $list->getContext();
        $item = $list->addItem($itemProperties);
        $ctx->executeQuery();
        return $item;
    }

}