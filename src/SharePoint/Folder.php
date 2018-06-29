<?php


namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;


/**
 * @property FileCollection Files
 */
class Folder extends ClientObject
{

    /**
     * The recommended way to delete a folder is to send a DELETE request to the Folder resource endpoint,
     * as shown in Folder request examples.
     */
    public function deleteObject(){
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
        //$this->removeFromParentCollection();
    }


    
    public function rename($name){
        $item = $this->getListItemAllFields();
        $item->setProperty('Title',$name);
        $item->setProperty('FileLeafRef', $name);
        $qry = new UpdateEntityQuery($item);
        $this->getContext()->addQuery($qry,$this);
    }

    /**
     * Moves the list folder to the Recycle Bin and returns the identifier of the new Recycle Bin item.
     */
    public function recycle(){
        $qry = new InvokePostMethodQuery($this->getResourcePath(),"recycle");
        $this->getContext()->addQuery($qry);
    }

    /**
     * Gets the collection of all files contained in the list folder.
     * You can add a file to a folder by using the Add method on the folder’s FileCollection resource.
     * @return FileCollection
     */
    public function getFiles()
    {
        if(!$this->isPropertyAvailable('Files')){
            $this->setProperty("Files", new FileCollection($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "Files")));
        }
        return $this->getProperty("Files");
    }


    /**
     * Gets the collection of list folders contained in the list folder.
     * @return FolderCollection
     */
    public function getFolders()
    {
        if(!$this->isPropertyAvailable("Folders")){
            $this->setProperty("Folders",
                new FolderCollection($this->getContext(), new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "folders")));
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
            $this->setProperty("ListItemAllFields",
                new ListItem(
                    $this->getContext(),
                    new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "ListItemAllFields")
                )
            );
        }
        return $this->getProperty("ListItemAllFields");
    }


    function setProperty($name, $value, $persistChanges = true)
    {
        parent::setProperty($name, $value, $persistChanges);
        if ($name == "UniqueId") {
            $this->setResourceUrl("Web/GetFolderById(guid'{$value}')");
        }
    }
}