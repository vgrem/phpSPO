<?php

namespace Office365;

use Office365\Graph\GraphServiceClient;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;
use PHPUnit\Framework\TestCase;


abstract class GraphTestCase extends TestCase
{
    /**
     * @var GraphServiceClient
     */
    protected static $graphClient;


    public static function setUpBeforeClass()
    {
        self::$graphClient = new GraphServiceClient(function () {
            return self::acquireToken();
        });
    }

    public static function tearDownAfterClass()
    {
        self::$graphClient = null;
    }


    public static function acquireToken()
    {
        $settings = include(__DIR__ . '/../Settings.php');
        $resource = "https://graph.microsoft.com";
        $provider = new AADTokenProvider($settings['TenantName']);
        return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
            new UserCredentials($settings['UserName'], $settings['Password']));
    }

}
