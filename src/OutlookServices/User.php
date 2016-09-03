<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionInvokePostMethod;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

/**
 * A user in the system.
 * The Me endpoint is provided as a shortcut for specifying the current user by SMTP address ( users/sadie@contoso.com).
 * @package Office365\PHP\Client\OutlookServices
 */
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
        $payload = new OperationParameterCollection();
        $payload->add("Message",$message);
        $payload->add("SaveToSentItems",$saveToSentItems);
        $action = new ClientActionInvokePostMethod($this, "SendMail", null, $payload);
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


    /**
     * @return EventCollection
     */
    public function getEvents(){
        if(!$this->isPropertyAvailable("Events")){
            $this->setProperty("Events",
                new EventCollection($this->getContext(),new ResourcePathEntity(
                    $this->getContext(),
                    $this->getResourcePath(),
                    "Events"
                )));
        }
        return $this->getProperty("Events");
    }


    /**
     * @return CalendarCollection
     */
    public function getCalendars(){
        if(!$this->isPropertyAvailable("Calendars")){
            $this->setProperty("Calendars",
                new CalendarCollection($this->getContext(),new ResourcePathEntity(
                    $this->getContext(),
                    $this->getResourcePath(),
                    "Calendars"
                )));
        }
        return $this->getProperty("Calendars");
    }


    /**
     * The user's alias. Typically the SMTP address of the user.
     * @var string
     */
    public $Alias;


    /**
     * The user's display name.
     * @var string
     */
    public $DisplayName;


}