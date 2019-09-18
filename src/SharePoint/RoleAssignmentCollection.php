<?php
/**
 * Represents a collection of RoleAssignment resources.
 */

namespace Office365\PHP\Client\SharePoint;


use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

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


    /**
     * Adds a role assignment to the collection of role assignment objects
     * @param $principalId
     * @param $roleDefId
     */
    public function addRoleAssignment($principalId,$roleDefId)
    {
        $qry = new InvokePostMethodQuery($this->getResourcePath(), "addroleassignment", array(
            "principalid" => $principalId,
            "roledefid" => $roleDefId
        ));
        $this->getContext()->addQuery($qry);
    }
}
