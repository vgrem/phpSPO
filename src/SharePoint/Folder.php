<?php

/**
 * Updated By PHP Office365 Generator 2019-11-16T19:13:59+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
/**
 * Represents 
 * a list 
 * folder on a site (2).Various folder properties in the Web class (section 3.2.5.143) 
 * return any from a site or subsite. Use the FolderCollection (section 3.2.5.73) 
 * that represents the collection of folders for a site or folder. Use an indexer 
 * to return a single folder from the collection.The ContentTypeOrder, ServerRelativePath and 
 * UniqueContentTypeOrder properties are not included in the default 
 * scalar property set for this type.
 */
class Folder extends ClientObject
{
    /**
     * The recommended way to delete a folder is to send a DELETE request to the Folder resource endpoint,
     * as shown in Folder request examples.
     */
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
        //$this->removeFromParentCollection();
    }
    public function rename($name)
    {
        $item = $this->getListItemAllFields();
        $item->setProperty('Title', $name);
        $item->setProperty('FileLeafRef', $name);
        $qry = new UpdateEntityQuery($item);
        $this->getContext()->addQuery($qry, $this);
    }
    /**
     * Moves the list folder to the Recycle Bin and returns the identifier of the new Recycle Bin item.
     */
    public function recycle()
    {
        $qry = new InvokePostMethodQuery($this->getResourcePath(), "recycle");
        $this->getContext()->addQuery($qry);
    }
    /**
     * Gets the collection of all files contained in the list folder.
     * You can add a file to a folder by using the Add method on the folder’s FileCollection resource.
     * @return FileCollection
     */
    public function getFiles()
    {
        if (!$this->isPropertyAvailable('Files')) {
            $this->setProperty("Files", new FileCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "Files")));
        }
        return $this->getProperty("Files");
    }
    /**
     * Gets the collection of list folders contained in the list folder.
     * @return FolderCollection
     */
    public function getFolders()
    {
        if (!$this->isPropertyAvailable("Folders")) {
            $this->setProperty("Folders", new FolderCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "folders")));
        }
        return $this->getProperty("Folders");
    }
    /**
     * Specifies the list item field (2) values for the list item corresponding to the folder.
     * @return ListItem
     */
    public function getListItemAllFields()
    {
        if (!$this->isPropertyAvailable("ListItemAllFields")) {
            $this->setProperty("ListItemAllFields", new ListItem($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "ListItemAllFields")));
        }
        return $this->getProperty("ListItemAllFields");
    }
    function setProperty($name, $value, $serializable = true)
    {
        parent::setProperty($name, $value, $serializable);
        if ($name == "UniqueId") {
            $this->setResourceUrl("Web/GetFolderById(guid'{$value}')");
        }
    }
    /**
     * Gets a 
     * Boolean value that indicates whether the folder exists.
     * @return bool
     */
    public function getExists()
    {
        if (!$this->isPropertyAvailable("Exists")) {
            return null;
        }
        return $this->getProperty("Exists");
    }
    /**
     * Gets a 
     * Boolean value that indicates whether the folder exists.
     * @var bool
     */
    public function setExists($value)
    {
        $this->setProperty("Exists", $value, true);
    }
    /**
     * Indicates 
     * whether the folder is enabled for WOPI default action.
     * @return bool
     */
    public function getIsWOPIEnabled()
    {
        if (!$this->isPropertyAvailable("IsWOPIEnabled")) {
            return null;
        }
        return $this->getProperty("IsWOPIEnabled");
    }
    /**
     * Indicates 
     * whether the folder is enabled for WOPI default action.
     * @var bool
     */
    public function setIsWOPIEnabled($value)
    {
        $this->setProperty("IsWOPIEnabled", $value, true);
    }
    /**
     * Specifies 
     * the count of items in the list folder.
     * @return integer
     */
    public function getItemCount()
    {
        if (!$this->isPropertyAvailable("ItemCount")) {
            return null;
        }
        return $this->getProperty("ItemCount");
    }
    /**
     * Specifies 
     * the count of items in the list folder.
     * @var integer
     */
    public function setItemCount($value)
    {
        $this->setProperty("ItemCount", $value, true);
    }
    /**
     * Specifies 
     * the list 
     * folder name.It MUST 
     * NOT be NULL. Its length MUST be equal to or less than 256. 
     * @return string
     */
    public function getName()
    {
        if (!$this->isPropertyAvailable("Name")) {
            return null;
        }
        return $this->getProperty("Name");
    }
    /**
     * Specifies 
     * the list 
     * folder name.It MUST 
     * NOT be NULL. Its length MUST be equal to or less than 256. 
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * Gets a 
     * string that identifies the application in which the folder was created.
     * @return string
     */
    public function getProgID()
    {
        if (!$this->isPropertyAvailable("ProgID")) {
            return null;
        }
        return $this->getProperty("ProgID");
    }
    /**
     * Gets a 
     * string that identifies the application in which the folder was created.
     * @var string
     */
    public function setProgID($value)
    {
        $this->setProperty("ProgID", $value, true);
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of the list folder.It MUST 
     * NOT be NULL. It MUST be a URL of server-relative form. 
     * @return string
     */
    public function getServerRelativeUrl()
    {
        if (!$this->isPropertyAvailable("ServerRelativeUrl")) {
            return null;
        }
        return $this->getProperty("ServerRelativeUrl");
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of the list folder.It MUST 
     * NOT be NULL. It MUST be a URL of server-relative form. 
     * @var string
     */
    public function setServerRelativeUrl($value)
    {
        $this->setProperty("ServerRelativeUrl", $value, true);
    }
    /**
     * Gets when 
     * the folder was created in UTC.
     * @return string
     */
    public function getTimeCreated()
    {
        if (!$this->isPropertyAvailable("TimeCreated")) {
            return null;
        }
        return $this->getProperty("TimeCreated");
    }
    /**
     * Gets when 
     * the folder was created in UTC.
     * @var string
     */
    public function setTimeCreated($value)
    {
        $this->setProperty("TimeCreated", $value, true);
    }
    /**
     * Gets the 
     * last time this folder or a direct child was modified in UTC.
     * @return string
     */
    public function getTimeLastModified()
    {
        if (!$this->isPropertyAvailable("TimeLastModified")) {
            return null;
        }
        return $this->getProperty("TimeLastModified");
    }
    /**
     * Gets the 
     * last time this folder or a direct child was modified in UTC.
     * @var string
     */
    public function setTimeLastModified($value)
    {
        $this->setProperty("TimeLastModified", $value, true);
    }
    /**
     * Gets the 
     * unique ID of the folder.
     * @return string
     */
    public function getUniqueId()
    {
        if (!$this->isPropertyAvailable("UniqueId")) {
            return null;
        }
        return $this->getProperty("UniqueId");
    }
    /**
     * Gets the 
     * unique ID of the folder.
     * @var string
     */
    public function setUniqueId($value)
    {
        $this->setProperty("UniqueId", $value, true);
    }
    /**
     * Specifies 
     * the server-relative 
     * URL for the list folderWelcome 
     * page.It MUST 
     * NOT be NULL. 
     * @return string
     */
    public function getWelcomePage()
    {
        if (!$this->isPropertyAvailable("WelcomePage")) {
            return null;
        }
        return $this->getProperty("WelcomePage");
    }
    /**
     * Specifies 
     * the server-relative 
     * URL for the list folderWelcome 
     * page.It MUST 
     * NOT be NULL. 
     * @var string
     */
    public function setWelcomePage($value)
    {
        $this->setProperty("WelcomePage", $value, true);
    }
    /**
     * Specifies 
     * the list 
     * folder.
     * @return Folder
     */
    public function getParentFolder()
    {
        if (!$this->isPropertyAvailable("ParentFolder")) {
            $this->setProperty("ParentFolder", new Folder($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "ParentFolder")));
        }
        return $this->getProperty("ParentFolder");
    }
}