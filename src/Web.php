<?php

namespace SharePoint\PHP\Client;


/**
 * Represents a SharePoint site. A site is a type of SP.SecurableObject.
 */
class Web extends ClientObject
{

 
    public function update($webUpdationInformation)
    {
        $this->payload = $webUpdationInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    public function deleteObject()
    {
        $qry = new ClientQuery($this,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }
   

    public function getLists()
    {
        if(!isset($this->Lists)){
            $this->Lists = new ListCollection($this->getContext(),"/_api/web/lists");
        }
        return $this->Lists;
    }

    public function getWebs()
    {
        if(!isset($this->Webs)){
            $this->Webs = new WebCollection($this->getContext(),"/_api/web/webs");
        }
        return $this->Webs;
    }


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


    public function getSiteUsers()
    {
        if(!isset($this->SiteUsers)){
            $this->SiteUsers = new UserCollection($this->getContext(),"/_api/web/siteusers");
        }
        return $this->SiteUsers;
    }


    public function getSiteGroups()
    {
        if(!isset($this->SiteGroups)){
            $this->SiteGroups = new GroupCollection($this->getContext(),"/_api/web/sitegroups");
        }
        return $this->SiteGroups;
    }

    public function getRoleAssignments()
    {
        if(!isset($this->RoleAssignments)){
            $this->RoleAssignments = new RoleAssignmentCollection($this->getContext(),"/_api/web/roleassignments");
        }
        return $this->RoleAssignments;
    }

    public function getFileByUrl($serverRelativeUrl){
        $encServerRelativeUrl = rawurlencode($serverRelativeUrl);
        $path = "/_api/web/getfilebyserverrelativeurl('$encServerRelativeUrl')";
        $file = new File($this->getContext(),$path);
        return $file;
    }

}