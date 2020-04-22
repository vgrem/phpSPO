<?php


namespace Office365\OneNote;


use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;

class Notebook extends ClientObject
{

    /**
     * @return UserRole
     */
    public function getUserRole()
    {
        if (!$this->isPropertyAvailable("UserRole")) {
            return null;
        }
        return $this->getProperty("UserRole");
    }


    /**
     * @return NotebookLinks
     */
    public function getNotebookLinks()
    {
        if (!$this->isPropertyAvailable("NotebookLinks")) {
            $this->setProperty("NotebookLinks",
                new NotebookLinks($this->getContext(), new ResourcePath(
                    "NotebookLinks",$this->getResourcePath())));
        }
        return $this->getProperty("NotebookLinks");
    }

}