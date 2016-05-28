<?php


use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ListCreationInformation;

class TestUtilities
{


    public static function createWeb(SharePoint\PHP\Client\ClientContext $ctx,$webUrl)
    {
        $web = $ctx->getWeb();
        $info = new \SharePoint\PHP\Client\WebCreationInformation($webUrl,$webUrl);
        $web = $web->getWebs()->add($info);
        $ctx->executeQuery();
        return $web;
    }
    
    
    
    public static function ensureList(SharePoint\PHP\Client\ClientContext $ctx,$listTitle,$type,$clearItems = true)
    {
        /*$lists = $ctx->getWeb()->getLists()->filter("Title eq '$listTitle'")->top(1);
        $ctx->load($lists);
        $ctx->executeQuery();
        if ($lists->getCount() == 1) {
            $existingList = $lists->getData()[0];
            if ($clearItems) {
                //self::deleteListItems($existingList);
            }
            return $existingList;
        }*/
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


    public static function createList(ClientContext $ctx,$listTitle,$type){
        $info = new ListCreationInformation($listTitle);
        $info->BaseTemplate = $type;
        $list = $ctx->getWeb()->getLists()->add($info);
        $ctx->executeQuery();
        return $list;
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