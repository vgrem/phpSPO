<?php


namespace Office365\OneDrive;


use Office365\Runtime\ClientObject;

class Item extends ClientObject
{

    /**
     *
     * @return string
     */
    public function getWebUrl(){
        return $this->getProperty("webUrl");
    }


    /**
     *
     * @param string $value
     */
    public function setWebUrl($value){
        $this->setProperty("webUrl",$value);
    }



    /**
     *
     * @return ItemCollection
     */
    public function getChildren(){
        return $this->getProperty("children");
    }


    /**
     *
     * @param ItemCollection $value
     */
    public function setChildren($value){
        $this->setProperty("children",$value);
    }


}