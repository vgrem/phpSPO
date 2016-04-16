<?php


namespace SharePoint\PHP\Client;


class Folder extends ClientObject
{

    /**
     * The recommended way to delete a folder is to send a DELETE request to the Folder resource endpoint,
     * as shown in Folder request examples.
     */
    public function deleteObject(){
        $qry = new ClientQuery($this,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Moves the list folder to the Recycle Bin and returns the identifier of the new Recycle Bin item.
     */
    public function recycle(){
        $this->resourcePath =  $this->resourcePath . "/recycle";
        $qry = new ClientQuery($this, ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Gets the collection of all files contained in the list folder.
     * You can add a file to a folder by using the Add method on the folder’s FileCollection resource.
     * @return FileCollection
     * @throws \Exception
     */
    public function getFiles()
    {
        if(!isset($this->Files)){
            $this->Files = new FileCollection($this->getContext(),$this->getResourcePath() . "/files");
        }
        return $this->Files;
    }

}