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
        return new User($this->getContext(),$this->getResourcePath(), "getbyid('{$id}')");
    }

    /**
     * Gets the user with the specified email address.
     * @param string $emailAddress The email of the user to get.
     * @return User
     */
    public function getByEmail($emailAddress)
    {
        return new User($this->getContext(),$this->getResourcePath(), "getbyemail('{$emailAddress}')");
    }

    /**
     * @param string $loginName
     * @return User
     */
    public function getByLoginName($loginName)
    {
        return new User($this->getContext(),$this->getResourcePath(), "getbyloginname('{$loginName}')");
    }


    /**
     * Removes the user with the specified ID.
     * @param int $id
     */
    public function removeById($id)
    {
        $userToDelete = new User($this->getContext());
        $qry = new ClientQuery($userToDelete->getUrl() . "/removebyid('{$id}')",ClientActionType::Delete);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Removes the user with the specified login name
     * @param string $loginName
     */
    public function removeByLoginName($loginName)
    {
        $userToDelete = new User($this->getContext());
        $qry = new ClientQuery($userToDelete->getUrl() . "/removebyloginname(@v)?@v='{$loginName}'",ClientActionType::Delete);
        $this->getContext()->addQuery($qry);
    }
}