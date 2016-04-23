<?php

namespace SharePoint\PHP\Client;


/**
 * Represents a SharePoint site. A site is a type of SP.SecurableObject.
 * @property ListCollection Lists
 * @property WebCollection Webs
 * @property FieldCollection Fields
 */
class Web extends ClientObject
{
    
    public function update(array $webUpdationInformation)
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Update,$webUpdationInformation);
        $qry->addResultObject($this);
        $this->getContext()->addQuery($qry);
    }

    public function deleteObject()
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Delete);
        $this->getContext()->addQuery($qry);
        //$this->removeFromParentCollection();
    }


    /**
     * Returns the collection of all changes from the change log that have occurred within the scope of the site, based on the specified query.
     * @param ChangeQuery $query
     * @return ChangeCollection
     */
    public function getChanges(ChangeQuery $query)
    {
        $changes = new ChangeCollection($this->getContext());
        $qry = new ClientQuery($this->getUrl() . "/getchanges",ClientActionType::PostRead,$query);
        $qry->addResultObject($changes);
        $this->getContext()->addQuery($qry);
        return $changes;
    }


    /**
     * Gets the collection of all lists that are contained in the Web site available to the current user
     * based on the permissions of the current user.
     * @return ListCollection
     */
    public function getLists()
    {
        if(!$this->isPropertyAvailable('Lists')){
            $this->Lists = new ListCollection($this->getContext(),$this->getResourcePath(),"lists");
        }
        return $this->Lists;
    }

    /**
     * Gets a Web site collection object that represents all Web sites immediately beneath the Web site,
     * excluding children of those Web sites.
     * @return WebCollection
     */
    public function getWebs()
    {
        if(!$this->isPropertyAvailable('Webs')){
            $this->Webs = new WebCollection($this->getContext(),$this->getResourcePath(),"webs");
        }
        return $this->Webs;
    }

    /**
     * Gets the collection of field objects that represents all the fields in the Web site.
     * @return FieldCollection
     */
    public function getFields()
    {
        if(!$this->isPropertyAvailable('Fields')){
            $this->Fields = new FieldCollection($this->getContext(),$this->getResourcePath(),"fields");
        }
        return $this->Fields;
    }

    /**
     * Gets the collection of all first-level folders in the Web site.
     * @return FolderCollection
     */
    public function getFolders()
    {
        if(!isset($this->Folders)){
            $this->Folders = new FolderCollection($this->getContext(),$this->getResourcePath(),"folders");
        }
        return $this->Folders;
    }


    /**
     * Gets the collection of all users that belong to the site collection.
     * @return UserCollection
     */
    public function getSiteUsers()
    {
        if(!isset($this->SiteUsers)){
            $this->SiteUsers = new UserCollection($this->getContext(),$this->getResourcePath(),"siteusers");
        }
        return $this->SiteUsers;
    }


    /**
     * Gets the collection of groups for the site collection.
     * @return mixed|null|GroupCollection
     */
    public function getSiteGroups()
    {
        if(!isset($this->SiteGroups)){
            $this->SiteGroups = new GroupCollection($this->getContext(),$this->getResourcePath(),"sitegroups");
        }
        return $this->SiteGroups;
    }

    /**
     * @return RoleAssignmentCollection
     */
    public function getRoleAssignments()
    {
        if(!isset($this->RoleAssignments)){
            $this->RoleAssignments = new RoleAssignmentCollection($this->getContext(),$this->getResourcePath(),"roleassignments");
        }
        return $this->RoleAssignments;
    }

    /**
     * Gets the collection of role definitions for the Web site.
     * @return RoleAssignmentCollection
     */
    public function getRoleDefinitions()
    {
        if(!isset($this->RoleDefinitions)){
            $this->RoleDefinitions = new RoleDefinitionCollection($this->getContext(),$this->getResourcePath(),"roledefinitions");
        }
        return $this->RoleDefinitions;
    }


    /**
     * Gets a value that specifies the collection of user custom actions for the site.
     * @return UserCustomActionCollection
     */
    public function getUserCustomActions()
    {
        if(!$this->isPropertyAvailable('UserCustomActions')){
            $this->UserCustomActions = new UserCustomActionCollection($this);
        }
        return $this->UserCustomActions;
    }

    /**
     * Returns the file object located at the specified server-relative URL.
     * @param $serverRelativeUrl The server relative URL of the file.
     * @return File
     */
    public function getFileByServerRelativeUrl($serverRelativeUrl){
        $encServerRelativeUrl = rawurlencode($serverRelativeUrl);
        $file = new File($this->getContext(),$this->getResourcePath(),"getfilebyserverrelativeurl('$encServerRelativeUrl')");
        return $file;
    }

    /**
     * Returns the folder object located at the specified server-relative URL.
     * @param $serverRelativeUrl The server relative URL of the folder.
     * @return Folder
     */
    public function getFolderByServerRelativeUrl($serverRelativeUrl){
        $encServerRelativeUrl = rawurlencode($serverRelativeUrl);
        $folder = new Folder($this->getContext(),$this->getResourcePath(),"getfolderbyserverrelativeurl('$encServerRelativeUrl')");
        return $folder;
    }
    
}