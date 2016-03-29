<?php
/**
 * Represents a collection of Group resources.
 */

namespace SharePoint\PHP\Client;


class GroupCollection extends ClientObjectCollection
{
    public function getById($id)
    {
        $group = new Group($this->getContext(),$this->getResourcePath() . "/getbyid('{$id}')");
        return $group;
    }

    public function getByName($name)
    {
        $group = new Group($this->getContext(),$this->getResourcePath() . "/getbyname('{$name}')");
        return $group;
    }

    public function removeById($id)
    {
        $groupToDelete = new Group($this->getContext(),$this->getResourcePath() . "/removebyid('{$id}')");
        $qry = new ClientQuery($groupToDelete,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }

    public function removeByLoginName($groupName)
    {
        $groupToDelete = new Group($this->getContext(),$this->getResourcePath() . "/removebyloginname('{$groupName}')");
        $qry = new ClientQuery($groupToDelete,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }
}