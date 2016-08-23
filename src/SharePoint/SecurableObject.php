<?php


namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

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