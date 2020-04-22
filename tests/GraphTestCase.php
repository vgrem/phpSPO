<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Office365\GraphClient\GraphServiceClient;
use Office365\Runtime\Auth\AuthenticationContext;
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
        $settings = include(__DIR__ . '/../Settings.php');
        self::$graphClient = new GraphServiceClient($settings['TenantName'], function (AuthenticationContext $authCtx) use ($settings) {
            self::acquireToken($authCtx, $settings['ClientId'], $settings['UserName'], $settings['Password']);
        });
    }

    public static function tearDownAfterClass()
    {
        self::$graphClient = null;
    }


    private static function acquireToken(AuthenticationContext $authCtx, $clientId, $userName, $password)
    {
        $resource = "https://graph.microsoft.com";
        try {
            $authCtx->acquireTokenForPassword($resource,
                $clientId,
                new UserCredentials($userName, $password));
        } catch (Exception $e) {
            print("Failed to acquire token");
        }
    }


}
