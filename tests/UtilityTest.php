<?php

use Office365\PHP\Client\SharePoint\ListItem;
use Office365\PHP\Client\SharePoint\ListTemplateType;
use Office365\PHP\Client\SharePoint\SPList;
use Office365\PHP\Client\SharePoint\Utilities\Utility;

//require_once('SharePointTestCase.php');


class UtilityTest extends SharePointTestCase
{

    /**
     * @var SPList
     */
    private static $discussionsList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = self::createUniqueName("Discussions");
        self::$discussionsList = self::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::DiscussionBoard);
    }

    public static function tearDownAfterClass()
    {
        self::$discussionsList->deleteObject();
        self::$context->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testCreateNewDiscussion()
    {
        $topicTitle = self::createUniqueName("Topic");
        $discussion = Utility::createNewDiscussion(self::$discussionsList,$topicTitle);
        self::assertEquals($discussion->getProperty("FileLeafRef"),$topicTitle);
        return $discussion;
    }


    /**
     * @depends testCreateNewDiscussion
     * @param ListItem $discussion
     * @throws Exception
     */
    public function testCreateNewDiscussionReply(ListItem $discussion)
    {
        $messageTitle = self::createUniqueName("Reply");
        Utility::createNewDiscussionReply($discussion,$messageTitle);
        $discussionFolder = $discussion->getFolder();
        self::$context->load($discussionFolder,array("ItemCount"));
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(1,$discussionFolder->getProperty("ItemCount"));
    }

}
