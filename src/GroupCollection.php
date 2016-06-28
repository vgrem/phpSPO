<?php
/**
 * Represents a collection of Group resources.
 */

namespace SharePoint\PHP\Client;

/**
 * Represents a collection of Group resources.
 */
class GroupCollection extends ClientObjectCollection
{

    /**
     * Create a group
     * @param GroupCreationInformation $parameters
     * @return Group
     */
    public function add(GroupCreationInformation $parameters)
    {
        $payload = array(
            '__metadata' => array('type' => 'SP.Group'),
            'Title' => $parameters->Title,
            'Description' => $parameters->Description
        );
        $group = new Group($this->getContext());
        $qry = new ClientAction($this->getUrl() . "/sitegroups",HttpMethod::Create,$payload);
        $this->getContext()->addQuery($qry,$group);
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
        $group = new Group($this->getContext(),$this->getResourcePath() . "/getbyid('{$id}')");
        return $group;
    }

    /**
     * Returns a cross-site group from the collection based on the name of the group.
     * @param string $name The name of the group. The group name is specified in its LoginName property.
     * @return Group
     * @throws \Exception
     */
    public function getByName($name)
    {
        $group = new Group($this->getContext(),$this->getResourcePath() . "/getbyname('{$name}')");
        return $group;
    }

    /**
     * Removes the group with the specified member ID from the collection.
     * @param int $id The ID of the group to remove.
     * @throws \Exception
     */
    public function removeById($id)
    {
        $groupToDelete = new Group($this->getContext());
        $qry = new ClientAction($groupToDelete,HttpMethod::Delete,"removebyid('{$id}')");
        $this->getContext()->addQuery($qry);
    }

    /**
     * Removes the cross-site group with the specified name from the collection.
     * @param string $groupName The name of the group to remove. The group name is specified in its LoginName property.
     * @throws \Exception
     */
    public function removeByLoginName($groupName)
    {
        $groupToDelete = new Group($this->getContext(),$this->getResourcePath() . "/removebyloginname('{$groupName}')");
        $qry = new ClientAction($groupToDelete,HttpMethod::Delete);
        $this->getContext()->addQuery($qry);
    }
}