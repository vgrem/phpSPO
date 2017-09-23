<?php


use Office365\PHP\Client\SharePoint\ListCreationInformation;
use Office365\PHP\Client\SharePoint\SPList;
use Office365\PHP\Client\SharePoint\Web;

class ListExtensions
{

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
        return ListExtensions::createList($web, $listTitle, $type);
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
     * @param \Office365\PHP\Client\SharePoint\SPList $list
     */
    public static function deleteList(\Office365\PHP\Client\SharePoint\SPList $list){
        $ctx = $list->getContext();
        $list->deleteObject();
        $ctx->executeQuery();
    }

}