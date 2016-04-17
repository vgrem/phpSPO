<?php

namespace SharePoint\PHP\Client;

require_once('PersonProperties.php');

class PeopleManager extends ClientObject
{
    public function __construct(ClientContext $ctx)
    {
        parent::__construct($ctx);
        $this->resourcePath = "/_api/sp.userprofiles.peoplemanager";
    }

    /**
     * Gets user properties for the current user.
     * @return PersonProperties
     */
    public function getMyProperties(){
        $personProperties = new PersonProperties($this->getContext(),$this->resourcePath . "/getmyproperties");
        return $personProperties;
    }

}