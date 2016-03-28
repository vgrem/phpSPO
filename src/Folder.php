<?php


namespace SharePoint\PHP\Client;


class Folder extends ClientObject
{
    public function getFiles()
    {
        if(!isset($this->Files)){
            $this->Files = new FileCollection($this->getContext(),$this->getResourcePath() . "/files");
        }
        return $this->Files;
    }

}