<?php


use Office365\OutlookServices\OutlookClient;
use Office365\Runtime\Auth\AuthenticationContext;
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
    protected static $testUserAccount;

    public static function setUpBeforeClass()
    {
        $settings = include(__DIR__ . '/../Settings.php');
        self::$context = new OutlookClient($settings['TenantName'],function (AuthenticationContext $ctx) use($settings) {
            //$resource = "https://graph.microsoft.com";
            $resource = "https://outlook.office365.com";
            try {
                $ctx->acquireTokenForPassword($resource,
                    $settings['ClientId'],
                    new UserCredentials($settings['UserName'],$settings['Password']));
            } catch (Exception $e) {
                print("Failed to acquire token");
            }
        });
        self::$testUserAccount = "mdoe@mediadev8.onmicrosoft.com";
    }

    public static function tearDownAfterClass()
    {
        self::$context = NULL;
    }

}
