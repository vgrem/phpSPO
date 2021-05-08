<?php

namespace Office365;


use Office365\Graph\Contact;
use Office365\OutlookServices\EmailAddress;

class OutlookContactTest extends GraphTestCase
{

    public function testCreateMyContact()
    {
        /** @var Contact $contact */
        $contact = self::$graphClient->getMe()->getContacts()->add();
        $contact->setGivenName("Pavel");
        $contact->setSurname("Bansky");
        $contact->getBusinessPhones()[] = "+1 732 555 0102";
        $contact->getEmailAddresses()->addChild(new EmailAddress("Pavel Bansky","pavelb@a830edad9050849NDA1.onmicrosoft.com"));
        self::$graphClient->executeQuery();
        self::assertNotNull($contact->getId());
        return $contact;
    }


    /**
     * @depends testCreateMyContact
     * @param Contact $contact
     */
    public function testFindMyContact(Contact $contact)
    {
        $id = $contact->getId();
        $foundContact = self::$graphClient->getMe()->getContacts()->getById($id)->get()->executeQuery();
        self::assertNotNull($foundContact);
    }


    /**
     * @depends testCreateMyContact
     * @param Contact $contact
     */
    public function testUpdateMyContact(Contact $contact)
    {
        $surnameValue = "Jr.";
        $contact->setSurname($surnameValue)->update()->executeQuery();
        //load updated contact
        /** @var Contact $existingContact */
        $existingContact = self::$graphClient->getMe()->getContacts()->getById($contact->getId())->get()->executeQuery();
        self::assertEquals($surnameValue,$existingContact->getSurname());
    }


    /**
     * @depends testCreateMyContact
     * @param Contact $contact
     */
    public function testDeleteMyContact(Contact $contact)
    {
        $contactIdToDelete = $contact->getId();
        $contact->deleteObject()->executeQuery();

        $contacts = self::$graphClient->getMe()->getContacts()->get()->executeQuery();
        $result = array_filter(
            $contacts->getData(),
            function (Contact $curContact) use ($contactIdToDelete) {
                return  $curContact->Id === $contactIdToDelete;
            }
        );
        self::assertEquals(0,count ($result));
    }

}
