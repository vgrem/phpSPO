<?php
/**
 * Represents a collection of RoleAssignment resources.
 */

namespace Office365\PHP\Client\SharePoint;


use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\InvokeMethodQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\ResourcePathServiceOperation;

/**
 * Represents a collection of RoleAssignment objects that defines all the role assignments for each securable object.
 */
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
     * @param $principalId string The unique identifier of the role assignment.
     * @param $roleDefId string
     */
    public function addRoleAssignment($principalId,$roleDefId)
    {
        $qry = new InvokePostMethodQuery($this->getResourcePath(), "addroleassignment", array(
            "principalid" => $principalId,
            "roledefid" => $roleDefId
        ));
        $this->getContext()->addQuery($qry);
    }

    /**
     * Gets the role assignment associated with the specified principal ID from the collection.
     * @param $principalId
     * @return RoleAssignment
     */
    public function getByPrincipalId($principalId)
    {
        $path = new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getByPrincipalId",array(
            $principalId
        ));
        $roleAssignment = new RoleAssignment($this->getContext(),$path);
        $this->addChild($roleAssignment);
        return $roleAssignment;
    }

    /**
     * Removes the role assignment with the specified principal and role definition from the collection.
     * @param $principalId string The unique identifier of the role assignment.
     * @param $roleDefId string
     */
    public function removeRoleAssignment($principalId,$roleDefId)
    {
        $qry = new InvokePostMethodQuery($this->getResourcePath(), "removeroleassignment", array(
            "principalid" => $principalId,
            "roledefid" => $roleDefId
        ));
        $this->getContext()->addQuery($qry);
    }
}
