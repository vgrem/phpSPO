<?php


namespace SharePoint\PHP\Client;

/**
 * Represents a user in Microsoft SharePoint Foundation. A user is a type of SP.Principal.
 * @property GroupCollection Groups
 */
class User  extends ClientObject
{
    public function update($userInformation)
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Update,$userInformation);
        $qry->addResultObject($this);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Gets the collection of groups of which the user is a member.
     * @return GroupCollection
     */
    public function getGroups()
    {
        if(!$this->isPropertyAvailable('Groups')){
            $this->Groups = new GroupCollection($this->getContext(), $this->getResourcePath(), "groups");
        }
        return $this->Groups;
    }

}