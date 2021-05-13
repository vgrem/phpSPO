<?php
/**
 * Represents a collection of Group resources.
 */

namespace Office365\SharePoint;

use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathServiceOperation;

/**
 * Represents a collection of Group resources.
 */
class GroupCollection extends BaseEntityCollection
{

    /**
     * GroupCollection constructor.
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath|null $resourcePath
     * @param ClientObject|null $parent
     */
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, Group::class, $parent);
    }

    /**
     * Create a group
     * @param GroupCreationInformation $parameters
     * @return Group
     */
    public function add(GroupCreationInformation $parameters)
    {
        $group = new Group($this->getContext());
        $qry = new InvokePostMethodQuery($this,null,null,null, $parameters);
        $this->getContext()->addQueryAndResultObject($qry, $group);
        $this->addChild($group);
        return $group;
    }

    /**
     * Returns a group from the collection based on the member ID of the group.
     * @param int $id The ID of the group to get.
     * @return Group The specified group.
     * @throws \Exception
     */
    public function getById($id)
    {
        return new Group(
            $this->getContext(),
            new ResourcePathServiceOperation("getById", array($id),$this->getResourcePath())
        );
    }

    /**
     * Returns a cross-site group from the collection based on the name of the group.
     * @param string $name The name of the group. The group name is specified in its LoginName property.
     * @return Group
     * @throws \Exception
     */
    public function getByName($name)
    {
        return new Group(
            $this->getContext(),
            new ResourcePathServiceOperation( "getByName", array(rawurlencode($name)), $this->getResourcePath())
        );
    }

    /**
     * Removes the group with the specified member ID from the collection.
     * @param int $id The ID of the group to remove.
     *
     * @return GroupCollection
     */
    public function removeById($id)
    {
        $qry = new InvokePostMethodQuery($this, "removeById", array($id));
        $this->getContext()->addQuery($qry);
        return $this;
    }

    /**
     * Removes the cross-site group with the specified name from the collection.
     * @param string $groupName The name of the group to remove. The group name is specified in its LoginName property.
     * @return GroupCollection
     */
    public function removeByLoginName($groupName)
    {
        $qry = new InvokePostMethodQuery($this, "removeByLoginName", array($groupName));
        $this->getContext()->addQuery($qry);
        return $this;
    }
}
