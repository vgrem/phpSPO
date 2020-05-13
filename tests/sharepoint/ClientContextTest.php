<?php

namespace Office365;

use Exception;

class ClientContextTest extends SharePointTestCase
{

    public function testIfSingleRequestProcessed()
    {
        try{
            $listTitle = "Orders_" . rand(1,100000);
            $list = self::$context->getWeb()->getLists()->getByTitle($listTitle);
            self::$context->load($list);
            self::$context->executeQuery();
            self::assertFalse(self::$context->hasPendingRequest());
        }
        catch(Exception $e){
            self::assertFalse(self::$context->hasPendingRequest());
        }
    }


    public function testIfMultipleRequestsProcessed()
    {
        $numOfQueries = 2;
        try {
            for ($i = 0;$i < $numOfQueries; $i++) {
                $listTitle = "Orders_" . rand(1, 100000);
                $list = self::$context->getWeb()->getLists()->getByTitle($listTitle);
                self::$context->load($list);
            }
            self::$context->executeQuery();
            self::assertFalse(self::$context->hasPendingRequest());
        } catch (Exception $e) {
            self::assertTrue(self::$context->hasPendingRequest());
        }
    }

}
