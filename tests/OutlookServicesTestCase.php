<?php

use Office365\PHP\Client\OutlookServices\OutlookClient;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\Utilities\ClientCredential;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;
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

        $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $settings['TenantName'];
        $authCtx = new AuthenticationContext($authorityUrl);
        $userCredentials = new UserCredentials($settings['UserName'],$settings['Password']);
        $clientCredentials = new ClientCredential($settings['ClientId'],$settings['ClientSecret']);
        //$resource = "https://graph.microsoft.com";
        $resource = "https://outlook.office365.com";
        $authCtx->acquireTokenForPassword($resource,$clientCredentials,$userCredentials);
        self::$context = new OutlookClient($authCtx);
        self::$testUserAccount = "mdoe@mediadev8.onmicrosoft.com";
    }

    public static function tearDownAfterClass()
    {
        self::$context = NULL;
    }

}
