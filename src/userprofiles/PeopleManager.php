<?php

namespace SharePoint\PHP\Client\UserProfiles;

use SharePoint\PHP\Client\ClientActionType;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ClientQuery;

require_once('PersonProperties.php');

class PeopleManager extends ClientObject
{
    public function __construct(ClientContext $ctx)
    {
        parent::__construct($ctx,null,"sp.userprofiles.peoplemanager");
    }

    /**
     * Gets user properties for the current user.
     * @return PersonProperties
     */
    public function getMyProperties(){
        return new PersonProperties($this->getContext(),$this->getResourcePath(),"getmyproperties");
    }


    /**
     * Gets the people who are following the current user.
     * @return PersonProperties
     */
    public function getMyFollowers(){
        return new PersonProperties($this->getContext(),$this->getResourcePath(),"getmyfollowers");
    }


    /**
     * Adds the specified user to the current user's list of followed users.
     * @param $accountName
     */
    public function follow($accountName){
        $qry = new ClientQuery($this->getUrl() . "/follow(@v)?@v='$accountName'", ClientActionType::Update);
        $this->getContext()->addQuery($qry);
    }


    /**
     * The URL of the edit profile page for the current user.
     * @var string
     */
    public $EditProfileLink;


    /**
     * A Boolean value that indicates whether the current user's People I'm Following list is public.
     * @var bool
     */
    public $IsMyPeopleListPublic;
}