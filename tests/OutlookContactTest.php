<?php

use Office365\PHP\Client\OutlookServices\Contact;
use Office365\PHP\Client\OutlookServices\EmailAddress;

require_once('OutlookServicesTestCase.php');


class OutlookContactTest extends OutlookServicesTestCase
{

    public function testCreateMyContact()
    {
        $contact = self::$context->getMe()->getContacts()->createContact();
        $contact->GivenName = "Pavel";
        $contact->Surname = "Bansky";
        $contact->BusinessPhones = array("+1 732 555 0102");
        $contact->EmailAddresses = array(
                new EmailAddress("Pavel Bansky","pavelb@a830edad9050849NDA1.onmicrosoft.com"),
                new EmailAddress("Jon Doe","jondb@0ewq12uy752t946ds4567NDF2.onmicrosoft.com")
            );
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
        $contactId = $contact->Id;
        $contacts = self::$context->getMe()->getContacts();
        self::$context->load($contacts);
        self::$context->executeQuery();
        $foundContact = $contacts->getItemById($contactId);
        self::assertNotNull($foundContact);
    }


    /**
     * @depends testCreateMyContact
     * @param Contact $contact
     */
    public function testUpdateMyContact(Contact $contact)
    {
        $surnameValue = "Jr.";
        $contact->Surname = $surnameValue;
        $contact->update();
        self::$context->executeQuery();

        //reload contact
        self::$context->load($contact);
        self::$context->executeQuery();
        self::assertEquals($surnameValue,$contact->getProperty("Surname"));
    }


    /**
     * @depends testCreateMyContact
     * @param Contact $contact
     */
    public function testDeleteMyContact(Contact $contact)
    {
        $contactIdToDelete = $contact->Id;
        $contact->deleteObject();
        self::$context->executeQuery();

        $contacts = self::$context->getMe()->getContacts();
        self::$context->load($contacts);
        self::$context->executeQuery();
        $result = array_filter(
            $contacts->getData(),
            function (Contact $curContact) use ($contactIdToDelete) {
                return  $curContact->Id === $contactIdToDelete;
            }
        );

        self::assertEquals(0,count ($result));
    }

}
