<?php


namespace Office365\OutlookServices;


use Office365\Runtime\ResourcePath;

class MailFolder extends OutlookEntity
{
    /**
     * The number of folders in the folder.
     * @var int
     */
    public $ChildFolderCount;

    /**
     * @return MessageCollection
     */
    public function getMessages()
    {
        if (!$this->isPropertyAvailable("Messages")) {
            $this->setProperty("Messages",
                new MessageCollection($this->getContext(),
                    new ResourcePath("Messages",$this->getResourcePath())));
        }
        return $this->getProperty("Messages");
    }

    /**
     * @return FolderCollection
     */
    public function getChildFolders()
    {
        if (!$this->isPropertyAvailable("ChildFolders")) {
            $this->setProperty("ChildFolders",
                new FolderCollection($this->getContext(), new ResourcePath(
                    "ChildFolders",
                    $this->getResourcePath()
                )));
        }

        return $this->getProperty("ChildFolders");
    }
}