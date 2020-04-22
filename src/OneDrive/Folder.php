<?php


namespace Office365\OneDrive;


class Folder extends Item
{

    /**
     *
     * @return int
     */
    public function getChildCount(){
        return $this->getProperty("childCount");
    }


    /**
     *
     * @param int $value
     */
    public function setChildCount($value){
        $this->setProperty("childCount",$value);
    }




}