<?php


use Office365\PHP\Client\SharePoint\Publishing\VideoChannel;
use Office365\PHP\Client\SharePoint\Publishing\VideoItem;
use Office365\PHP\Client\SharePoint\Publishing\VideoServiceDiscoverer;
use Office365\PHP\Client\SharePoint\Publishing\VideoServiceManager;

class VideoServiceTest extends SharePointTestCase
{

    /**
     * @var $manager VideoServiceManager
     */
    protected static $manager;


    /**
     * @var $targetChannel VideoChannel
     */
    protected static $targetChannel;


    public function testGetDiscoverer()
    {
        $discoverer = new VideoServiceDiscoverer(self::$context);
        self::$context->load($discoverer);
        self::$context->executeQuery();
        self::assertNotNull($discoverer->getVideoPortalUrl());
        return $discoverer;
    }


    /**
     * @depends testGetDiscoverer
     * @param VideoServiceDiscoverer $discoverer
     * @return VideoChannel
     */
    public function testEnsureChannel(VideoServiceDiscoverer $discoverer)
    {
        self::$manager = new VideoServiceManager(self::$context,$discoverer->getVideoPortalUrl());
        $channels = self::$manager->getChannels();
        self::$context->load($channels);
        self::$context->executeQuery();


        $channelName = "Community"; //TestUtilities::createUniqueName("Channel");
        $result = $channels->findItems(
            function (VideoChannel $item) use ($channelName) {
                return  $item->getProperty("Title") === $channelName;
            });

        if(is_null($result)){
            self::$targetChannel = $channels->add($channelName); #oh crap.. not supported by REST service yet
            self::$context->executeQuery();
        }
        else{
            self::$targetChannel = $result[0];
        }

        self::assertEquals(self::$targetChannel->getProperty("Title"),$channelName);
        return self::$targetChannel;
    }


    /**
     * @depends testEnsureChannel
     * @param VideoChannel $channel
     * @return VideoItem
     */
    public function testCreateVideo(VideoChannel $channel)
    {
        $videoTitle = self::createUniqueName("Video");
        $videoFileName = $videoTitle . ".mp4";
        $video = $channel->getVideos()->add($videoTitle,$videoTitle,$videoFileName);
        self::$context->executeQuery();
        self::assertNotNull($video->getProperty("Url"));
        self::assertEquals($video->getProperty("FileName"),$videoFileName);
        return $video;
    }

    /**
     * @depends testCreateVideo
     * @param VideoItem $videoItem
     */
    public function testUploadVideo(VideoItem $videoItem)
    {
        $parentPath = basename(getcwd()) === "tests" ? "../" : "./";
        $filePath = "${parentPath}examples/data/big_buck_bunny.mp4";
        $videoContent = file_get_contents($filePath);
        $videoItem->saveBinaryStream($videoContent);
        self::assertTrue(true);
    }

    /**
     * @depends testCreateVideo
     * @param VideoItem $videoItem
     */
    public function testUpdateVideo(VideoItem $videoItem)
    {
        $desc = self::createUniqueName("Video sample");
        $videoItem->setProperty("Description",$desc);
        $videoItem->update();
        self::$context->executeQuery();

        $result = self::$targetChannel->getAllVideos()->filter("Description eq '$desc'");
        self::$context->load($result);
        self::$context->executeQuery();
        self::assertNotEmpty($result->getCount());
    }


    /**
     * @depends testCreateVideo
     * @param VideoItem $videoItem
     */
    public function testDeleteVideo(VideoItem $videoItem)
    {
        $videoId = $videoItem->getProperty("ID");
        $videoItem->deleteObject();
        self::$context->executeQuery();

        $allVideos = self::$targetChannel->getAllVideos();
        self::$context->load($allVideos);
        self::$context->executeQuery();
        $result = $allVideos->findItems(
            function (VideoItem $item) use ($videoId) {
                return  $item->getProperty("ID") === $videoId;
            });
        self::assertNull($result);
    }


}
