<?php
/**
 * Represents a collection of User resources
 */

namespace SharePoint\PHP\Client;


class UserCollection extends ClientObjectCollection
{

    /**
     * Gets the user with the specified member identifier (ID).
     * @param int $id
     * @return User
     */
    public function getById($id)
    {
        $path = new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getById",array($id));
        return new User($this->getContext(),$path);
    }

    /**
     * Gets the user with the specified email address.
     * @param string $emailAddress The email of the user to get.
     * @return User
     */
    public function getByEmail($emailAddress)
    {
        $path = new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getByEmail",array($emailAddress));
        return new User($this->getContext(),$path);
    }

    /**
     * @param string $loginName
     * @return User
     */
    public function getByLoginName($loginName)
    {
        $path = new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getByLoginName",array($loginName));
        return new User($this->getContext(),$path);
    }


    /**
     * Removes the user with the specified ID.
     * @param int $id
     */
    public function removeById($id)
    {
        $userToDelete = new User($this->getContext());
        $qry = new ClientAction($userToDelete->getUrl() . "/removebyid('{$id}')",HttpMethod::Delete);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Removes the user with the specified login name
     * @param string $loginName
     */
    public function removeByLoginName($loginName)
    {
        $userToDelete = new User($this->getContext());
        $qry = new ClientAction($userToDelete->getUrl() . "/removebyloginname(@v)?@v='{$loginName}'",HttpMethod::Delete);
        $this->getContext()->addQuery($qry);
    }
}