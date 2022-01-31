<?php

namespace Office365;

use Office365\SharePoint\UserProfiles\ProfileLoader;
use Office365\SharePoint\UserProfiles\UserProfile;


class UserProfileTest extends SharePointTestCase
{

    /**
     * @var UserProfile
     */
    protected static $profileLoader;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }

    public function testGetUserProfile()
    {
        self::$profileLoader = ProfileLoader::getProfileLoader(self::$context)->executeQuery();
        $this->assertNotNull(self::$profileLoader->getResourcePath());
    }


}
