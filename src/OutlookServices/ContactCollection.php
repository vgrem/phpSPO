<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionCreateEntity;
use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\ClientValueObjectCollection;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class ContactCollection extends ClientObjectCollection
{
    /**
     * @param Contact $contact
     */
    public function addContact(Contact $contact)
    {
        $qry = new ClientActionCreateEntity($this, ODataPayload::createFromObject($contact));
        $this->getContext()->addQuery($qry, $contact);
        $this->addChild($contact);
    }


    /**
     * Get a contact by using the contact ID.
     * @param string $contactId
     * @return Contact
     */
    function getById($contactId){
        return new Contact(
            $this->getContext(),
            new ResourcePathEntity($this->getContext(),$this->getResourcePath(),$contactId)
        );
    }
}