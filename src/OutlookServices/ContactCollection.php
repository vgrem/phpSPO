<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\CreateEntityQuery;
use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\ResourcePath;

class ContactCollection extends ClientObjectCollection
{

    /**
     * Creates Contact resource
     * @return Contact
     */
    public function createContact() {
        $contact = new Contact($this->getContext());
        $this->addChild($contact);
        $qry = new CreateEntityQuery($contact);
        $this->getContext()->addQueryAndResultObject($qry, $contact);
        return $contact;
    }


    /**
     * Get a contact by using the contact ID.
     * @param string $contactId
     * @return Contact
     */
    function getById($contactId){
        return new Contact(
            $this->getContext(),
            new ResourcePath($contactId,$this->getResourcePath())
        );
    }
}