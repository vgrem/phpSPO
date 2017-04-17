<?php


use Office365\PHP\Client\SharePoint\Publishing\VideoChannel;
use Office365\PHP\Client\SharePoint\Publishing\VideoItem;
use Office365\PHP\Client\SharePoint\Publishing\VideoServiceDiscoverer;
use Office365\PHP\Client\SharePoint\Publishing\VideoServiceManager;

class VideoServiceTest extends SharePointTestCase
{

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
        $manager = new VideoServiceManager(self::$context,$discoverer->getVideoPortalUrl());
        $channels = $manager->getChannels();
        self::$context->load($channels);
        self::$context->executeQuery();


        $channelName = "Community"; //TestUtilities::createUniqueName("Channel");
        $result = $channels->findItems(
            function (VideoChannel $item) use ($channelName) {
                return  $item->getProperty("Title") === $channelName;
            });

        if(is_null($result)){
            $targetChannel = $channels->add($channelName); #oh crap.. not supported by REST service yet
            self::$context->executeQuery();
        }
        else{
            $targetChannel = $result[0];
        }

        self::assertEquals($targetChannel->getProperty("Title"),$channelName);
        return $targetChannel;
    }


    /**
     * @depends testEnsureChannel
     * @param VideoChannel $channel
     * @return \Office365\PHP\Client\SharePoint\Publishing\VideoItem
     */
    public function testCreateVideo(VideoChannel $channel)
    {
        $videoTitle = TestUtilities::createUniqueName("Video");
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

    }


}