<?php


use SharePoint\PHP\Client\ClientActionCreateEntity;

class ContactCollection extends \SharePoint\PHP\Client\ClientObjectCollection
{

    /**
     * Create a contact in the specified Contacts folder.
     * @return Contact
     */
    public function createContact()
    {
        $contact = new Contact($this->getContext(),$this->getResourcePath());
        //foreach($contactCreationInformation as $key => $value){
        //    $contact->setProperty($key,$value);
        //}
        $qry = new ClientActionCreateEntity($this,$contact->convertToPayload());
        $this->getContext()->addQuery($qry,$contact);
        return $contact;
    }
}