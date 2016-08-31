<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionInvokePostMethod;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class User extends ClientObject
{

    /**
     * @return MessageCollection
     */
    public function getMessages(){
        if(!$this->isPropertyAvailable("Messages")){
            $this->setProperty("Messages",
                new MessageCollection($this->getContext(),new ResourcePathEntity(
                    $this->getContext(),
                    $this->getResourcePath(),
                    "Messages"
                )));
        }
        return $this->getProperty("Messages");
    }


    /**
     * @param Message $message
     * @param bool $saveToSentItems
     */
    public function sendEmail(Message $message, $saveToSentItems)
    {
        $info = new SendMailInformation($message,$saveToSentItems);
        $action = new ClientActionInvokePostMethod($this, "SendMail", null, $info);
        $this->getContext()->addQuery($action);
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