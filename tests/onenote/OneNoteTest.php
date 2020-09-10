<?php

namespace Office365;


class OneNoteTest extends GraphTestCase
{

    public function testListPages(){
        $pages = self::$graphClient->getMe()->getOnenote()->getPages()->get()->executeQuery();
        self::assertNotNull($pages->getServerObjectIsNull());
    }

}