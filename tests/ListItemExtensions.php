<?php


use Office365\PHP\Client\SharePoint\File;
use Office365\PHP\Client\SharePoint\ListItem;
use Office365\PHP\Client\SharePoint\SPList;
use Office365\PHP\Client\SharePoint\TemplateFileType;


class ListItemExtensions
{

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
            $items[] = ListItemExtensions::createListItem($targetList, $itemProperties);
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
