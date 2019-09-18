<?php


namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

/**
 * An object that can be assigned security permissions.
 */
class SecurableObject extends ClientObject
{


    /**
     * Creates unique role assignments for the securable object.
     * @param bool $copyRoleAssignments
     */
    public function breakRoleInheritance($copyRoleAssignments)
    {
        $qry = new InvokePostMethodQuery($this->getResourcePath(),"breakroleinheritance",array(
            $copyRoleAssignments
        ));
        $this->getContext()->addQuery($qry);
    }


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

    /**
     * Gets a Boolean value indicating whether the object has unique security or
     * inherits its role assignments from a parent object.
     * @return bool
     */
    public function hasUniqueRoleAssignments()
    {
        return $this->getProperty('HasUniqueRoleAssignments');
    }

}
