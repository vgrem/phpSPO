<?php

namespace Office365;

use Office365\OutlookServices\OutlookClient;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;
use PHPUnit\Framework\TestCase;


abstract class OutlookServicesTestCase extends TestCase
{
    /**
     * @var OutlookClient
     */
    protected static $context;
    /**
     * @var string
     */
    protected static $testAccountName;

    public static function setUpBeforeClass()
    {
        self::$context = new OutlookClient(function () {
            return self::acquireToken();
        });
        $settings = include(__DIR__ . '/../../Settings.php');
        self::$testAccountName = $settings['TestAccountName'];
    }

    public static function tearDownAfterClass()
    {
        self::$context = NULL;
    }


    public static function acquireToken(){
        $settings = include(__DIR__ . '/../../Settings.php');
        $resource = "https://outlook.office365.com";
        $provider = new AADTokenProvider($settings['TenantName']);
        return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
            new UserCredentials($settings['UserName'], $settings['Password']));
    }

}
