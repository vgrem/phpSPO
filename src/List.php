<?php
    
namespace SharePoint\PHP\Client;


/**
 * Represents a SharePoint list resource.
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
        $item = new ListItem($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"items"));
        $item->setProperty('ParentList',$this,false);
        foreach($listItemCreationInformation as $key => $value){
            $item->setProperty($key,$value);
        }
        $qry = new ClientAction($item->getResourceUrl(),$item->toJson(),HttpMethod::Post);
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
        return new ListItem($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"items({$id})"));
    }

    /**
     * Creates unique role assignments for the securable object.
     * @param bool $copyRoleAssignments
     * @param bool $clearSubScopes
     * @throws \Exception
     */
    public function breakRoleInheritance($copyRoleAssignments, $clearSubScopes)
    {
        $qry = new ClientActionUpdateMethod($this->getResourceUrl(),"breakroleinheritance",array(
            $copyRoleAssignments,
            $clearSubScopes
        ));
        $this->getContext()->addQuery($qry);
    }

    /**
     * Returns a collection of items from the list based on the specified query.
     * @param CamlQuery $camlQuery
     * @return ListItemCollection
     */
    public function getItems(CamlQuery $camlQuery = null)
    {
        $items = new ListItemCollection($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"items"));
        if(isset($camlQuery)){
            $qry = new ClientAction($this->getResourceUrl() . "/GetItems", $camlQuery->toJson(),HttpMethod::Post);
            $this->getContext()->addQuery($qry,$items);
        }
        return $items;
    }


    /**
     * Updates a list resource
     */
    public function update()
    {
        $qry = new ClientActionUpdateEntity($this->getResourceUrl(),$this->toJson());
        $this->getContext()->addQuery($qry);
    }

    /**
     * The recommended way to delete a list is to send a DELETE request to the List resource endpoint, as shown in List request examples.
     */
    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this->getResourceUrl());
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
        $permissions = new BasePermissions();
        $qry = new ClientActionInvokeMethod($this->getResourceUrl(), "getusereffectivepermissions",array(
            rawurlencode($loginName)
        ),HttpMethod::Get);
        $this->getContext()->addQuery($qry,$permissions);
        return $permissions;
    }


    /**
     * @param ChangeLogItemQuery $query The query that contains the change token. Pass this parameter in the request body, as shown in the request example.
     * @return ListItemCollection
     */
    public function getListItemChangesSinceToken(ChangeLogItemQuery $query)
    {
        $result = new ListItemCollection(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getListItemChangesSinceToken")
        );
        $qry = new ClientAction($result->getResourceUrl(),$query->toJson(),HttpMethod::Post);
        $qry->setDataFormatType(FormatType::Xml);
        $this->getContext()->addQuery($qry,$result);
        return $result;
    }


    /**
     * @param ChangeQuery $query
     * @return ChangeCollection
     */
    public function getChanges(ChangeQuery $query)
    {
        $changes = new ChangeCollection(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getChanges")
        );
        $qry = new ClientAction($changes->getResourceUrl(),$query->toJson(),HttpMethod::Post);
        $this->getContext()->addQuery($qry,$changes);
        return $changes;
    }


    /**
     * @return FieldCollection
     */
    public function getFields()
    {
        if(!$this->isPropertyAvailable('Fields')){
            $this->setProperty("Fields", new FieldCollection($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "fields")));
        }
        return $this->getProperty("Fields");
    }

    /**
     * @return Folder
     */
    public function getRootFolder()
    {
        if(!$this->isPropertyAvailable('RootFolder')){
            $this->setProperty("RootFolder", new Folder($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "rootFolder")));
        }
        return $this->getProperty("RootFolder");
    }


    /**
     * @return ViewCollection
     */
    public function getViews()
    {
        if(!$this->isPropertyAvailable('Views')){
            $this->setProperty("Views",new ViewCollection($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "views")));
        }
        return $this->getProperty("Views");
    }

    public function getInformationRightsManagementSettings()
    {
        if(!$this->isPropertyAvailable('InformationRightsManagementSettings')){
            $this->setProperty("InformationRightsManagementSettings", new InformationRightsManagementSettings($this->getContext(),$this->getResourcePath(), "InformationRightsManagementSettings"));
        }
        return $this->getProperty("InformationRightsManagementSettings");
    }


    /**
     * @return Web
     */
    public function getParentWeb()
    {
        if(!$this->isPropertyAvailable('ParentWeb')){
            $this->setProperty("ParentWeb", new Web($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "ParentWeb")));
        }
        return $this->getProperty("ParentWeb");
    }

    public function getEntityTypeName(){
        return "SP.List";
    }
}