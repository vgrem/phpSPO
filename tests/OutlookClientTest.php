<?php

require_once(__DIR__ .'/../examples/Settings.php');
require_once(__DIR__ . '/../src/Runtime/Auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../src/OutlookServices/OutlookClient.php');


class OutlookClientTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var OutlookClient
     */
    protected static $context;

    public static function setUpBeforeClass()
    {
        global $Settings;
        $authCtx = new \SharePoint\PHP\Client\NetworkCredentialContext($Settings["UserName"],$Settings["Password"]);
        self::$context = new OutlookClient($authCtx);
    }

    public function testGetMyContacts()
    {
        $contacts = self::$context->getMyContacts();
        self::$context->load($contacts);
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(0,$contacts->getCount());
    }

}
