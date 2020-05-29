<?php

namespace Office365;


class OneNoteTest extends GraphTestCase
{

    public function testListPages(){
        $pages = self::$graphClient->getMe()->getOnenote()->getPages();
        self::$graphClient->load($pages);
        self::$graphClient->executeQuery();
        self::assertNotNull($pages->getServerObjectIsNull());
    }



}