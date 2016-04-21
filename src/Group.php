<?php

namespace SharePoint\PHP\Client;


/**
 * @property UserCollection Users
 */
class Group extends ClientObject
{

    /**
     * Gets a collection of user objects that represents all of the users in the group.
     * @return UserCollection
     */
    public function getUsers()
    {
        if(!$this->isPropertyAvailable('Users')){
            $this->Users = new UserCollection($this->getContext(),$this->getResourcePath() , "users");
        }
        return $this->Users;
    }
}