<?php
    
namespace SharePoint\PHP\Client;


/**
 * Represents a SharePoint list.
 * @property FieldCollection Fields
 * @property Folder RootFolder
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
        $item = new ListItem($this->getContext());
        $item->setParentList($this);
        $qry = new ClientQuery($this->getUrl() . "/items",ClientActionType::Create,$listItemCreationInformation);
        $qry->addResultObject($item);
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
        return new ListItem($this->getContext(),$this->getResourcePath(),"items({$id})");
    }

    /**
     * Creates unique role assignments for the securable object.
     * @param bool $copyroleassignments
     * @param bool $clearsubscopes
     * @throws \Exception
     */
    public function breakRoleInheritance($copyroleassignments,$clearsubscopes)
    {
        $url = $this->getUrl() . "/breakroleinheritance(" . var_export($copyroleassignments, true) . "," . var_export($clearsubscopes,true) . ")";
        $qry = new ClientQuery($url, ClientActionType::Update);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Returns a collection of items from the list based on the specified query.
     * @return ListItemCollection
     * @throws \Exception
     */
    public function getItems()
    {
        return new ListItemCollection($this->getContext(),$this->getResourcePath(),"items");
    }


    /**
     * Updates a list resource
     * @param array $listUpdationInformation
     */
    public function update($listUpdationInformation)
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Update,$listUpdationInformation);
        $qry->addResultObject($this);
        $this->getContext()->addQuery($qry);
    }

    /**
     * The recommended way to delete a list is to send a DELETE request to the List resource endpoint, as shown in List request examples.
     */
    public function deleteObject()
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Delete);
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
        $permissions = new BasePermissions();
        $qry = new ClientQuery($this->getUrl() . "/getusereffectivepermissions(@user)?@user='$loginName'",ClientActionType::Read);
        $qry->addResultValue($permissions);
        $this->getContext()->addQuery($qry);
        return $permissions;
    }


    /**
     * @param ChangeLogItemQuery $query The query that contains the change token. Pass this parameter in the request body, as shown in the request example.
     * @return BasePermissions
     */
    /*public function getListItemChangesSinceToken(ChangeLogItemQuery $query)
    {
        $result = new ClientValueObject();
        $qry = new ClientQuery($this->getUrl() . "/getlistitemchangessincetoken",ClientActionType::Update,$query);
        $qry->addResultValue($result);
        $this->getContext()->addQuery($qry);
        return $result;
    }*/


    public function getChanges(ChangeQuery $query)
    {
        $changes = new ChangeCollection($this->getContext());
        //"{ 'query': { '__metadata': { 'type': 'SP.ChangeQuery' }, 'Web': true, 'Update': true } }"
        $qry = new ClientQuery($this->getUrl() . "/getchanges",ClientActionType::PostRead,$query);
        $qry->addResultObject($changes);
        $this->getContext()->addQuery($qry);
        return $changes;
    }


    public function getFields()
    {
        if(!$this->isPropertyAvailable('Fields')){
            $this->Fields = new FieldCollection($this->getContext(),$this->getResourcePath(), "fields");
        }
        return $this->Fields;
    }


    public function getRootFolder()
    {
        if(!$this->isPropertyAvailable('RootFolder')){
            $this->RootFolder = new Folder($this->getContext(),$this->getResourcePath(), "rootFolder");
        }
        return $this->RootFolder;
    }

    public function getEntityTypeName(){
        return "SP.List";
    }
}