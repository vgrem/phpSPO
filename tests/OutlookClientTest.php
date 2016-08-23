<?php

use Office365\PHP\Client\OutlookServices\OutlookClient;
use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;

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
        $authCtx = new NetworkCredentialContext($Settings["UserName"],$Settings["Password"]);
        self::$context = new OutlookClient($authCtx);
    }

    public function testGetMyContacts()
    {
        $contacts = self::$context->getMyContacts();
        self::$context->load($contacts);
        self::$context->executeQuery();
        self::assertGreaterThanOrEqual(0,$contacts->getCount());
    }


    /*public function testCreateMyContact()
    {
        $contact = self::$context->getMyContacts()->createContact();
        $contact->GivenName = "Pavel";
        $contact->Surname = "Bansky";
        $contact->BusinessPhones[] = "+1 732 555 0102";
        $contact->EmailAddresses[] = new EmailAddress("Pavel Bansky","pavelb@a830edad9050849NDA1.onmicrosoft.com");

        self::$context->executeQuery();
        self::assertNotNull($contact->getProperty("Id"));
    }*/

}
