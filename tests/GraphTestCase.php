<?php

namespace Office365;

use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;
use PHPUnit\Framework\TestCase;


abstract class GraphTestCase extends TestCase
{
    /**
     * @var GraphServiceClient
     */
    protected static $graphClient;
    /**
     * @var string
     */
    protected static $testAccountName;

    protected  static $settings;


    public static function setUpBeforeClass(): void
    {
        self::$settings = include(__DIR__ . '/Settings.php');
        self::$testAccountName = self::$settings['TestAccountName'];
        self::$graphClient = new GraphServiceClient(function () {
            return self::acquireToken();
        });
    }

    public static function tearDownAfterClass(): void
    {
        self::$graphClient = null;
    }


    public static function acquireToken()
    {
        $resource = "https://graph.microsoft.com";
        $provider = new AADTokenProvider(self::$settings['TenantName']);
        return $provider->acquireTokenForPassword($resource, self::$settings['ClientId'],
            new UserCredentials(self::$settings['UserName'], self::$settings['Password']));
    }

    public static function createUniqueName($prefix){
        return  $prefix . "_" . rand(1, 100000);
    }
}
