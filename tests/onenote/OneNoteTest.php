<?php

namespace Office365;


class OneNoteTest extends GraphTestCase
{

    public function testListPages(){
        $sections = self::$graphClient->getMe()->getOnenote()->getSections()->top(1)->get()->executeQuery();
        self::assertGreaterThan(0, $sections->getCount());
        $pages = $sections[0]->getPages()->top(10)->get()->executeQuery();
        self::assertNotNull($pages->getServerObjectIsNull());
    }

}