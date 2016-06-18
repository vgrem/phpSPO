<?php
    
namespace SharePoint\PHP\Client;


/**
 * Represents a SharePoint list.
 * @property FieldCollection Fields
 * @property Folder RootFolder
 * @property ViewCollection Views
 * @property InformationRightsManagementSettings InformationRightsManagementSettings
 */
class SPList extends SecurableObject
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
        $item->setProperty('ParentList',$this,false);
        foreach($listItemCreationInformation as $key => $value){
            $item->setProperty($key,$value);
        }
        $qry = new ClientQuery($this->getUrl() . "/items",ClientActionType::Create,$item);
        $this->getContext()->addQuery($qry,$item);
        return $item;
    }

    /**
     * Returns the list item with the specified list item identifier.
     * @param $id  SPList Item id
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
     * @param CamlQuery $camlQuery
     * @return ListItemCollection
     */
    public function getItems(CamlQuery $camlQuery = null)
    {
        if(isset($camlQuery)){
            $items = new ListItemCollection($this->getContext());
            $qry = new ClientQuery($this->getUrl() . "/GetItems",ClientActionType::PostRead,$camlQuery);
            $this->getContext()->addQuery($qry,$items);
            return $items;
        }
        return new ListItemCollection($this->getContext(),$this->getResourcePath(),"items");
    }


    /**
     * Updates a list resource
     */
    public function update()
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Update,$this);
        $this->getContext()->addQuery($qry);
    }

    /**
     * The recommended way to delete a list is to send a DELETE request to the List resource endpoint, as shown in List request examples.
     */
    public function deleteObject()
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Delete);
        $this->getContext()->addQuery($qry);
        $this->removeFromParentCollection();
    }


    /**
     * Gets the set of permissions for the specified user
     * @param string $loginName
     * @return BasePermissions
     * @throws \Exception
     */
    public function getUserEffectivePermissions($loginName)
    {
        $encLoginName = rawurlencode($loginName);
        $permissions = new BasePermissions();
        $qry = new ClientQuery($this->getUrl() . "/getusereffectivepermissions(@user)?@user='$encLoginName'",ClientActionType::Read);
        $this->getContext()->addQuery($qry,$permissions);
        return $permissions;
    }


    /**
     * @param ChangeLogItemQuery $query The query that contains the change token. Pass this parameter in the request body, as shown in the request example.
     * @return ListItemCollection
     */
    public function getListItemChangesSinceToken(ChangeLogItemQuery $query)
    {
        $result = new ListItemCollection($this->getContext());
        $qry = new ClientQuery($this->getUrl() . "/getlistitemchangessincetoken",ClientActionType::PostRead,$query);
        $qry->setResponseFormatType(ClientFormatType::Xml);
        $this->getContext()->addQuery($qry,$result);
        return $result;
    }


    public function getChanges(ChangeQuery $query)
    {
        $changes = new ChangeCollection($this->getContext());
        $qry = new ClientQuery($this->getUrl() . "/getchanges",ClientActionType::PostRead,$query);
        $this->getContext()->addQuery($qry,$changes);
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


    public function getViews()
    {
        if(!$this->isPropertyAvailable('Views')){
            $this->Views = new ViewCollection($this->getContext(),$this->getResourcePath(), "views");
        }
        return $this->Views;
    }

    public function getInformationRightsManagementSettings()
    {
        if(!$this->isPropertyAvailable('InformationRightsManagementSettings')){
            $this->InformationRightsManagementSettings = new InformationRightsManagementSettings($this->getContext(),$this->getResourcePath(), "InformationRightsManagementSettings");
        }
        return $this->InformationRightsManagementSettings;
    }

    public function getEntityTypeName(){
        return "SP.List";
    }
}