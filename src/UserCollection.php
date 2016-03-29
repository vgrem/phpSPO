<?php
/**
 * Represents a collection of User resources
 */

namespace SharePoint\PHP\Client;


class UserCollection extends ClientObjectCollection
{

    public function getById($id)
    {
        return new User($this->getContext(),$this->getResourcePath() . "/getbyid('{$id}')");
    }

    public function getByEmail($emailAddress)
    {
        return new User($this->getContext(),$this->getResourcePath() . "/getbyemail('{$emailAddress}')");
    }

    public function getByLoginName($loginName)
    {
        return new User($this->getContext(),$this->getResourcePath() . "/getbyloginname('{$loginName}')");
    }

    public function removeById($id)
    {
        $userToDelete = new User($this->getContext(),$this->getResourcePath() . "/removebyid('{$id}')");
        $qry = new ClientQuery($userToDelete,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Removes the user with the specified login name
     */
    public function removeByLoginName($loginName)
    {
        $userToDelete = new User($this->getContext(),$this->getResourcePath() . "/removebyloginname(@v)?@v='{$loginName}'");
        $qry = new ClientQuery($userToDelete,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }
}