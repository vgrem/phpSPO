<?php

use Office365\PHP\Client\OutlookServices\Contact;
use Office365\PHP\Client\OutlookServices\EmailAddress;
use Office365\PHP\Client\OutlookServices\Message;
use Office365\PHP\Client\OutlookServices\OutlookClient;
use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;
use Office365\PHP\Client\Runtime\OData\ODataPayload;

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


    /*public function testSendEmail(){
        $message = self::$context->getMe()->createMessage();
        $message->setProperty("Subject","--test--");
        self::$context->getMe()->sendEmail($message,false);
        self::$context->executeQuery();
    }*/




    public function testCreateMyContact()
    {
        $contact = self::$context->getMe()->createContact();
        $contact->setProperty("GivenName", "Pavel");
        $contact->setProperty("Surname","Bansky");
        $contact->setProperty("BusinessPhones", array("+1 732 555 0102"));
        $contact->setProperty("EmailAddresses",
            array(
                new EmailAddress("Pavel Bansky","pavelb@a830edad9050849NDA1.onmicrosoft.com"),
                new EmailAddress("Jon Doe","jondb@0ewq12uy752t946ds4567NDF2.onmicrosoft.com")
            ));
        self::$context->getMe()->getContacts()->addContact($contact);
        self::$context->executeQuery();
        self::assertNotNull($contact->getProperty("Id"));
        return $contact;

    }


    /**
     * @depends testCreateMyContact
     * @param Contact $contact
     */
    public function testFindMyContact(Contact $contact)
    {
        $contactId = $contact->getProperty("Id");
        $contact = self::$context->getMe()->getContacts()->getById($contactId);
        self::$context->load($contact);
        self::$context->executeQuery();
        self::assertEquals($contactId,$contact->getProperty("Id"));
    }


    /**
     * @depends testCreateMyContact
     */
    /*public function testUpdateMyContact(Contact $contact)
    {
        $surnameValue = "Jr.2";
        $contact->setProperty("Surname",$surnameValue);
        $contact->update();
        self::$context->executeQuery();

        //reload contact
        self::$context->load($contact);
        self::$context->executeQuery();
        self::assertEquals($surnameValue,$contact->getProperty("Surname"));
    }*/


    /**
     * @depends testCreateMyContact
     * @param Contact $contact
     */
    /*public function testDeleteMyContact(Contact $contact)
    {
        $contactIdToDelete = $contact->getProperty("Id");
        $contact->deleteObject();
        self::$context->executeQuery();

        $contacts = self::$context->getMe()->getContacts();
        self::$context->load($contacts);
        self::$context->executeQuery();
        $result = array_filter(
            $contacts->getData(),
            function (Contact $curContact) use ($contactIdToDelete) {
                return  $curContact->getProperty("Id") === $contactIdToDelete;
            }
        );

        self::assertEquals(0,count ($result));
    }*/

}
