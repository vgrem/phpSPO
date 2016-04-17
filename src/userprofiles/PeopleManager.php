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


    /**
     * Gets the people who are following the current user.
     * @return PersonProperties
     */
    public function getMyFollowers(){
        $personProperties = new PersonProperties($this->getContext(),$this->resourcePath . "/getmyfollowers");
        return $personProperties;
    }


    /**
     * Adds the specified user to the current user's list of followed users.
     * @param $accountName
     */
    public function follow($accountName){
        $qry = new ClientQuery($this, ClientOperationType::Update,"/follow(@v)?@v='$accountName'");
        $this->getContext()->addQuery($qry);
    }

}