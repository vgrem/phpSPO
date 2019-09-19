<?php


namespace Office365\PHP\Client\SharePoint;


use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\InvokeMethodQuery;
use Office365\PHP\Client\Runtime\ResourcePathServiceOperation;


/**
 * Represents the collection of RoleDefinition objects that define the role definitions that are available for use within the Web site.
 */
class RoleDefinitionCollection extends ClientObjectCollection
{

    /**
     * Gets the role definition with the specified ID from the collection.
     * @param $Id string The ID of the role definition.
     * @return RoleDefinition
     */
    public function getById($Id)
    {
        $path = new ResourcePathServiceOperation($this->getContext(), $this->getResourcePath(), "getbyid", array(
            $Id
        ));
        $roleDef = new RoleDefinition($this->getContext(), $path);
        $this->addChild($roleDef);
        return $roleDef;
    }

    /**
     * Gets the role definition with the specified name.
     * @param $name string The name of the role definition.
     * @return RoleDefinition
     */
    public function getByName($name)
    {
        $path = new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getbyname",array(
            $name
        ));
        $roleDef = new RoleDefinition($this->getContext(),$path);
        $this->addChild($roleDef);
        return $roleDef;
    }


    /**
     * Gets the role definition with the specified role type.
     * @param $type string he RoleTypeKind of the role definition. See RoleType object for a list of role type values.
     * @return RoleDefinition
     */
    public function getByType($type)
    {
        $qry = new InvokeMethodQuery($this->getResourcePath(), "getbytype", array(
            $type
        ));
        $roleDef = new RoleDefinition($this->getContext(),$qry->getResourcePath());
        $this->getContext()->addQuery($qry,$roleDef);
        $this->addChild($roleDef);
        return $roleDef;
    }

}
