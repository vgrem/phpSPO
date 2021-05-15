<?php

namespace Office365;

use Office365\SharePoint\ListItem;
use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;
use Office365\SharePoint\Utilities\Utility;

class UtilityTest extends SharePointTestCase
{

    /**
     * @var SPList
     */
    private static $discussionsList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = "Discussions123"; //self::createUniqueName("Discussions");
        self::$discussionsList = self::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::DiscussionBoard);
    }

    public static function tearDownAfterClass()
    {
        //self::$discussionsList->deleteObject()->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testCreateNewDiscussion()
    {
        $topicTitle = self::createUniqueName("Topic");
        $discussion = Utility::createNewDiscussion(self::$discussionsList,$topicTitle)->executeQuery();
        $targetItem = $discussion->select("FileLeafRef")->get()->executeQuery();
        self::assertEquals($targetItem->getProperty("FileLeafRef"),$topicTitle);
        return $discussion;
    }


    /**
     * @depends testCreateNewDiscussion
     * @param ListItem $discussion
     * @throws \Exception
     */
    public function testCreateNewDiscussionReply(ListItem $discussion)
    {
        $messageTitle = self::createUniqueName("Reply");
        Utility::createNewDiscussionReply($discussion,$messageTitle)->executeQuery();
        $discussionFolder = $discussion->getFolder();
        self::$context->load($discussionFolder,array("ItemCount"));
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(1,$discussionFolder->getItemCount());
    }

}
