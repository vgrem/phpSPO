<?php

namespace Office365;


use Office365\Outlook\Contact;
use Office365\Outlook\EmailAddress;
use Office365\Runtime\Http\RequestException;

class OutlookContactTest extends GraphTestCase
{

    public function testCreateMyContact()
    {
        /** @var Contact $contact */
        $contact = self::$graphClient->getMe()->getContacts()->add();
        $contact->setGivenName("Pavel");
        $contact->setSurname("Bansky");
        $contact->getBusinessPhones()[] = "+1 732 555 0102";
        $contact->setEmailAddresses([new EmailAddress("Pavel Bansky","pavelb@a830edad9050849NDA1.onmicrosoft.com")]);
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
        $existingContact = $contact->get()->executeQuery();
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
        try {
            self::$graphClient->getMe()->getContacts()->getById($contactIdToDelete)->get()->executeQuery();
        }
        catch (RequestException $ex){
            self::assertEquals(404, $ex->getCode());
        }
    }

}
