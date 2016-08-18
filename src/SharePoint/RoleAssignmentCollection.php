<?php
/**
 * Represents a collection of RoleAssignment resources.
 */

namespace SharePoint\PHP\Client;


class RoleAssignmentCollection extends ClientObjectCollection
{
    /**
     * @return GroupCollection
     */
    public function getGroups()
    {
        if(!$this->isPropertyAvailable("Groups")){
            $this->setProperty("Groups", new GroupCollection($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"Groups")));
        }
        return $this->getProperty("Groups");
    }
}