<?php

namespace Office365;

use Exception;
use Office365\Graph\GraphServiceClient;
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
        self::$graphClient = new GraphServiceClient($settings['TenantName'], function (AuthenticationContext $authCtx)
        use ($settings) {
            self::acquireToken($authCtx, $settings['ClientId'], $settings['UserName'], $settings['Password']);
        });
    }

    public static function tearDownAfterClass()
    {
        self::$graphClient = null;
    }


    /**
     * @param AuthenticationContext $authCtx
     * @param $clientId
     * @param $userName
     * @param $password
     * @throws Exception
     */
    public static function acquireToken(AuthenticationContext $authCtx, $clientId, $userName, $password)
    {
        $resource = "https://graph.microsoft.com";
        $authCtx->acquireTokenForPassword($resource,$clientId,new UserCredentials($userName, $password));
    }

}
