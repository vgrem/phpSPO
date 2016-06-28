<?php


namespace SharePoint\PHP\Client;


class SecurableObject extends ClientObject
{
    /**
     * @return RoleAssignmentCollection
     */
    public function getRoleAssignments()
    {
        if(!isset($this->RoleAssignments)){
            $this->setProperty('RoleAssignments',new RoleAssignmentCollection($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"roleassignments")));
        }
        return $this->getProperty('RoleAssignments');
    }
}