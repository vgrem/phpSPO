<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionInvokePostMethod;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\OData\ODataPayloadKind;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class User extends ClientObject
{


    /**
     * @param Message $message
     * @param bool $saveToSentItems
     */
    public function sendEmail(Message $message, $saveToSentItems)
    {
        $value = new \stdClass();
        $value->Message = $message;
        $value->SaveToSentItems = $saveToSentItems;
        $payload = new ODataPayload($value, ODataPayloadKind::Entity);
        $action = new ClientActionInvokePostMethod($this, "SendMail", null, $payload);
        $this->getContext()->addQuery($action);
    }


    /**
     * @return Message
     */
    public function createMessage(){
        return new Message($this->getContext(),$this->getResourcePath());
    }



    /**
     * Creates a contact in the specified Contacts folder.
     * @return Contact
     */
    public function createContact()
    {
        return new Contact($this->getContext(),$this->getResourcePath());
    }



    /**
     * @return ContactCollection
     */
    public function getContacts(){
        if(!$this->isPropertyAvailable("Contacts")){
            $this->setProperty("Contacts",
                new ContactCollection($this->getContext(),new ResourcePathEntity(
                    $this->getContext(),
                    $this->getResourcePath(),
                    "Contacts"
                )));
        }
        return $this->getProperty("Contacts");
    }

}