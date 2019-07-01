<?php

use Office365\PHP\Client\SharePoint\ListItem;
use Office365\PHP\Client\SharePoint\ListTemplateType;
use Office365\PHP\Client\SharePoint\SPList;
use Office365\PHP\Client\SharePoint\Utilities\Utility;

require_once('SharePointTestCase.php');
require_once('ListItemExtensions.php');

class UtilityTest extends SharePointTestCase
{

    /**
     * @var SPList
     */
    private static $discussionsList;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        $listTitle = ListItemExtensions::createUniqueName("Discussions");
        self::$discussionsList = ListExtensions::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::DiscussionBoard);
    }

    public static function tearDownAfterClass(): void
    {
        self::$discussionsList->deleteObject();
        self::$context->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testCreateNewDiscussion()
    {
        $topicTitle = ListItemExtensions::createUniqueName("Topic");
        $discussion = Utility::createNewDiscussion(self::$discussionsList,$topicTitle);
        self::assertEquals($discussion->getProperty("FileLeafRef"),$topicTitle);
        return $discussion;
    }


    /**
     * @depends testCreateNewDiscussion
     * @param ListItem $discussion
     */
    public function testCreateNewDiscussionReply(ListItem $discussion)
    {
        $messageTitle = ListItemExtensions::createUniqueName("Reply");
        Utility::createNewDiscussionReply($discussion,$messageTitle);
        $discussionFolder = $discussion->getFolder();
        self::$context->load($discussionFolder,array("ItemCount"));
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(1,$discussionFolder->getProperty("ItemCount"));
    }

}
