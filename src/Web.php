<?php

namespace SharePoint\PHP\Client;


/**
 * Represents a SharePoint site. A site is a type of SP.SecurableObject.
 */
class Web extends ClientObject
{

 
    public function update(array $webUpdationInformation)
    {
        $this->payload = $webUpdationInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    public function deleteObject()
    {
        $qry = new ClientQuery($this,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
        //$this->removeFromParentCollection();
    }

    /**
     * Gets the collection of all lists that are contained in the Web site available to the current user
     * based on the permissions of the current user.
     * @return ListCollection
     */
    public function getLists()
    {
        if(!isset($this->Lists)){
            $this->Lists = new ListCollection($this->getContext(),"/_api/web/lists");
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
            $this->Webs = new WebCollection($this->getContext(),"/_api/web/webs");
        }
        return $this->Webs;
    }

    /**
     * Gets the collection of field objects that represents all the fields in the Web site.
     * @return FieldCollection
     */
    public function getFields()
    {
        if(!isset($this->Fields)){
            $this->Fields = new FieldCollection($this->getContext(),"/_api/web/fields");
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
            $this->Folders = new FolderCollection($this->getContext(),"/_api/web/folders");
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
            $this->SiteUsers = new UserCollection($this->getContext(),"/_api/web/siteusers");
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
            $this->SiteGroups = new GroupCollection($this->getContext(),"/_api/web/sitegroups");
        }
        return $this->SiteGroups;
    }

    /**
     * @return mixed|null|RoleAssignmentCollection
     */
    public function getRoleAssignments()
    {
        if(!isset($this->RoleAssignments)){
            $this->RoleAssignments = new RoleAssignmentCollection($this->getContext(),"/_api/web/roleassignments");
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
            $this->RoleDefinitions = new RoleDefinitionCollection($this->getContext(),"/_api/web/roledefinitions");
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
            $this->UserCustomActions = new UserCustomActionCollection($this->getContext(),"/_api/web/usercustomactions");
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
        $path = "/_api/web/getfilebyserverrelativeurl('$encServerRelativeUrl')";
        $file = new File($this->getContext(),$path);
        return $file;
    }

    /**
     * Returns the folder object located at the specified server-relative URL.
     * @param $serverRelativeUrl The server relative URL of the folder.
     * @return Folder
     */
    public function getFolderByServerRelativeUrl($serverRelativeUrl){
        $encServerRelativeUrl = rawurlencode($serverRelativeUrl);
        $path = "/_api/web/getfolderbyserverrelativeurl('$encServerRelativeUrl')";
        $folder = new Folder($this->getContext(),$path);
        return $folder;
    }


    

}