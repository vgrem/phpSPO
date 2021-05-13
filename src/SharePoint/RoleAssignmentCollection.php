<?php
/**
 * Represents a collection of RoleAssignment resources.
 */

namespace Office365\SharePoint;


use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathServiceOperation;

/**
 * Represents a collection of RoleAssignment objects that defines all the role assignments for each securable object.
 */
class RoleAssignmentCollection extends BaseEntityCollection
{

    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, RoleAssignment::class, $parent);
    }

    /**
     * @return GroupCollection
     */
    public function getGroups()
    {
        return $this->getProperty("Groups",
            new GroupCollection($this->getContext(),new ResourcePath("Groups",$this->getResourcePath())));
    }


    /**
     * Adds a role assignment to the collection of role assignment objects
     * @param $principalId string The unique identifier of the role assignment.
     * @param $roleDefId string
     */
    public function addRoleAssignment($principalId,$roleDefId)
    {
        $qry = new InvokePostMethodQuery($this, "addroleassignment", array(
            "principalid" => $principalId,
            "roledefid" => $roleDefId
        ));
        $this->getContext()->addQuery($qry);
        return $this;
    }

    /**
     * Gets the role assignment associated with the specified principal ID from the collection.
     * @param $principalId
     * @return RoleAssignment
     */
    public function getByPrincipalId($principalId)
    {
        $path = new ResourcePathServiceOperation("getByPrincipalId",array(
            $principalId
        ),$this->getResourcePath());
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
        $qry = new InvokePostMethodQuery($this, "removeroleassignment", array(
            "principalid" => $principalId,
            "roledefid" => $roleDefId
        ));
        $this->getContext()->addQuery($qry);
        return $this;
    }
}
