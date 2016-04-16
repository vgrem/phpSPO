<?php


namespace SharePoint\PHP\Client;

/**
 * Represents a user in Microsoft SharePoint Foundation. A user is a type of SP.Principal.
 */
class User  extends ClientObject
{
    public function update($userInformation)
    {
        $this->payload = $userInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Gets the collection of groups of which the user is a member.
     * @return mixed|null|GroupCollection
     */
    public function getGroups()
    {
        if(!isset($this->Groups)){
            $this->Groups = new GroupCollection($this->getContext(), $this->getResourcePath() . "/groups");
        }
        return $this->Groups;
    }

}