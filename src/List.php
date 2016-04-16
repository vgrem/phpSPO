<?php
    
namespace SharePoint\PHP\Client;


/**
 * Represents a SharePoint list.
 */
class SPList extends ClientObject
{


    /**
     * The recommended way to add a list item is to send a POST request to the ListItemCollection resource endpoint, as shown in ListItemCollection request examples.
     * @param array $listItemCreationInformation Creation information for a List item
     * @return ListItem List Item resource
     * @throws \Exception
     */
    public function addItem(array $listItemCreationInformation)
    {
        $path = $this->getResourcePath() . "/items";
        $item = new ListItem($this->getContext(),$path,null,$listItemCreationInformation);
        $item->setParentList($this);
        $qry = new ClientQuery($item,ClientOperationType::Create);
        $this->getContext()->addQuery($qry);
        return $item;
    }

    /**
     * Returns the list item with the specified list item identifier.
     * @param $id  List Item id
     * @return ListItem  List Item resource
     * @throws \Exception
     */
    public function getItemById($id)
    {
        $resoursePath = $this->getResourcePath() . "/items({$id})";
        $item = new ListItem($this->getContext(),$resoursePath);
        return $item;
    }

    /**
     * Creates unique role assignments for the securable object.
     * @param bool $copyroleassignments
     * @param bool $clearsubscopes
     * @throws \Exception
     */
    public function breakRoleInheritance($copyroleassignments,$clearsubscopes)
    {
        //$this->resourcePath =  $this->resourcePath . "/breakroleinheritance(" . var_export($copyroleassignments, true) . "," . var_export($clearsubscopes,true) . ")";
        $this->resourcePath =  $this->resourcePath . "/breakroleinheritance($copyroleassignments,$clearsubscopes)";
        $qry = new ClientQuery($this, ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Returns a collection of items from the list based on the specified query.
     * @return ListItemCollection
     * @throws \Exception
     */
    public function getItems()
    {
        $resoursePath = $this->getResourcePath() . "/items";
        $items = new ListItemCollection($this->getContext(),$resoursePath);
        return $items;
    }


    /**
     * Updates a list resource
     * @param array $listUpdationInformation
     */
    public function update($listUpdationInformation)
    {
        $this->payload = $listUpdationInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    /**
     * The recommended way to delete a list is to send a DELETE request to the List resource endpoint, as shown in List request examples.
     */
    public function deleteObject()
    {
        $qry = new ClientQuery($this,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Gets the set of permissions for the specified user
     * @param string $loginName
     * @return ListItemCollection
     * @throws \Exception
     */
    public function getUserEffectivePermissions($loginName)
    {
        $encLoginName = rawurlencode($loginName);
        $path = $this->getResourcePath() . "/getusereffectivepermissions(@user)?@user='$encLoginName'";
        $permissions = new BasePermissions();
        //$this->getContext()->addQuery($qry);
        return $permissions;
    }


    public function getFields()
    {
        if(!isset($this->Fields)){
            $this->Fields = new FieldCollection($this->getContext(),$this->getResourcePath() . "/fields");
        }
        return $this->Fields;
    }


    public function getRootFolder()
    {
        if(!isset($this->RootFolder)){
            $this->RootFolder = new Folder($this->getContext(),$this->getResourcePath() . "/rootFolder");
        }
        return $this->RootFolder;
    }

    public function getEntityTypeName(){
        return "SP.List";
    }
}