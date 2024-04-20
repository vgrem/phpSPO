<?php

namespace Office365;

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
        self::$graphClient = GraphServiceClient::withUserCredentials(
            self::$settings['TenantName'],
            self::$settings['ClientId'],
            self::$settings['UserName'],
            self::$settings['Password']
        );
    }

    public static function tearDownAfterClass(): void
    {
        self::$graphClient = null;
    }

    public static function createUniqueName($prefix){
        return  $prefix . "_" . rand(1, 100000);
    }
}
