<?php
/**
 * Represents a collection of User resources
 */

namespace Office365\SharePoint;


use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ResourcePathServiceOperation;

class UserCollection extends ClientObjectCollection
{

    /**
     * Add a user
     * @param string $loginName
     * @return User
     */
    public function addUser($loginName)
    {
        $user = new User($this->getContext());
        $user->setProperty('LoginName',$loginName);
        $qry = new InvokePostMethodQuery($this,null,null,null,$user);
        $this->getContext()->addQueryAndResultObject($qry,$user);
        $this->addChild($user);
        return $user;
    }

    /**
     * Gets the user with the specified member identifier (ID).
     * @param int $id
     * @return User
     */
    public function getById($id)
    {
        $path = new ResourcePathServiceOperation("getById",array($id),$this->getResourcePath());
        return new User($this->getContext(),$path);
    }

    /**
     * Gets the user with the specified email address.
     * @param string $emailAddress The email of the user to get.
     * @return User
     */
    public function getByEmail($emailAddress)
    {
        $path = new ResourcePathServiceOperation("getByEmail",array($emailAddress),$this->getResourcePath());
        return new User($this->getContext(),$path);
    }

    /**
     * @param string $loginName
     * @return User
     */
    public function getByLoginName($loginName)
    {
        $path = new ResourcePathServiceOperation("getByLoginName",array($loginName),$this->getResourcePath());
        return new User($this->getContext(),$path);
    }


    /**
     * Removes the user with the specified ID.
     * @param int $id
     */
    public function removeById($id)
    {
        $qry = new InvokePostMethodQuery($this,"removeById",array($id));
        $this->getContext()->addQuery($qry);
    }

    /**
     * Removes the user with the specified login name
     * @param string $loginName
     */
    public function removeByLoginName($loginName)
    {
        $qry = new InvokePostMethodQuery(
            $this,
            "removeByLoginName",
            array(rawurlencode($loginName)));
        $this->getContext()->addQuery($qry);
    }

}
