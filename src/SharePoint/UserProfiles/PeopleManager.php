<?php

namespace SharePoint\PHP\Client\UserProfiles;

use SharePoint\PHP\Client\ClientActionInvokeGetMethod;
use SharePoint\PHP\Client\ClientActionInvokePostMethod;
use SharePoint\PHP\Client\ClientRuntimeContext;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ClientResult;
use SharePoint\PHP\Client\ResourcePathEntity;
use SharePoint\PHP\Client\ResourcePathServiceOperation;

require_once('PersonProperties.php');
require_once('PersonPropertiesCollection.php');

/**
 * Provides methods for operations related to people.
 * ref: https://msdn.microsoft.com/en-us/library/office/dn790354.aspx#bk_PeopleManagerMethods
 */
class PeopleManager extends ClientObject
{
    public function __construct(ClientRuntimeContext $ctx)
    {
        parent::__construct($ctx,new ResourcePathEntity($ctx,null,"sp.UserProfiles.peoplemanager"));
    }


    /**
     * Checks whether the specified user is following the current user.
     * @param string $accountName
     * @return ClientResult
     */
    public function amIFollowedBy ($accountName){
        $clientResult = new ClientResult();
        $qry = new ClientActionInvokePostMethod($this, "amifollowedby",array(rawurlencode($accountName)));
        $this->getContext()->addQuery($qry,$clientResult);
        return $clientResult;
    }

    /**
     * Gets user properties for the current user.
     * @return PersonProperties
     */
    public function getMyProperties(){
        return new PersonProperties(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getmyproperties")
        );
    }


    /**
     * Gets the people who are following the current user.
     * @return PersonProperties
     */
    public function getMyFollowers(){
        return new PersonProperties(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getmyfollowers")
        );
    }


    /**
     * Adds the specified user to the current user's list of followed users.
     * @param string $accountName
     */
    public function follow($accountName){
        $qry = new ClientActionInvokePostMethod($this, "follow",array(rawurlencode($accountName)));
        $this->getContext()->addQuery($qry);
    }


    /**
     * Remove the specified user from the current user's list of followed users.
     * @param string $accountName
     */
    public function stopFollowing ($accountName){
        $qry = new ClientActionInvokePostMethod($this, "stopfollowing",array(rawurlencode($accountName)));
        $this->getContext()->addQuery($qry);
    }


    /**
     * Checks whether the current user is following the specified user.
     * @param string $accountName
     * @return ClientResult
     */
    public function amIFollowing ($accountName){
        $clientResult = new ClientResult();
        $qry = new ClientActionInvokeGetMethod(
            $this,
            "amifollowing",
            array(rawurlencode($accountName))
        );
        $this->getContext()->addQuery($qry,$clientResult);
        return $clientResult;
    }


    /**
     * @param string $accountName The account name of the user, encoded and passed as an alias in the query string,
     * as shown in the request example. See Implementation notes for other example formats.
     * @return PersonPropertiesCollection
     */
    public function getFollowersFor($accountName){
        return new PersonPropertiesCollection(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getfollowersfor",array(rawurlencode($accountName)))
        );
    }


    /**
     * Gets the specified user profile property for the specified user.
     * @param string $accountName The account name of the user, encoded and passed as an alias in the query string, as shown in the request example.
     * @param string $propertyName The case-sensitive name of the property to get.
     * @return ClientResult The specified profile property for the specified user.
     */
    public function getUserProfilePropertyFor ($accountName,$propertyName)
    {
        $clientResult = new ClientResult();
        $qry = new ClientActionInvokeGetMethod(
            $this,
            "getuserprofilepropertyfor",
            array(
                "accountname" => rawurlencode($accountName),
                "propertyname" => $propertyName
            )
        );
        $this->getContext()->addQuery($qry, $clientResult);
        return $clientResult;
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