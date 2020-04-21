<?php

namespace Office365\PHP\Client\OneDrive;

use Office365\PHP\Client\OneNote\OneNote;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePath;

class CurrentUserRequestContext extends ClientObject
{

    /**
     * @return OneNote
     */
    public function getOneNote()
    {
        if (!$this->isPropertyAvailable("OneNote")) {
            $this->setProperty("OneNote",
                new OneNote($this->getContext(), new ResourcePath(
                    "OneNote",
                    $this->getResourcePath()
                )));
        }
        return $this->getProperty("OneNote");
    }


    /**
     * @return Drive
     */
    public function getDrive()
    {
        if (!$this->isPropertyAvailable("Drive")) {
            $this->setProperty("Drive",
                new Drive($this->getContext(), new ResourcePath(
                    "Drive",
                    $this->getResourcePath()
                )));
        }
        return $this->getProperty("Drive");
    }


    /**
     * @return FileCollection
     */
    public function getFiles()
    {
        if (!$this->isPropertyAvailable("Files")) {
            $this->setProperty("Files",
                new FileCollection($this->getContext(), new ResourcePath(
                    "Files",
                    $this->getResourcePath()
                )));
        }
        return $this->getProperty("Files");
    }

}
