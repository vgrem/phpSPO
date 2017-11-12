<?php


namespace Office365\PHP\Client\OneDrive;



use Office365\PHP\Client\FileServices\ImageFacet;

class File extends Item
{

    /**
     *
     * @return string
     */
    public function getContentUrl(){
        return $this->getProperty("contentUrl");
    }


    /**
     *
     * @param string $value
     */
    public function setContentUrl($value){
        $this->setProperty("contentUrl",$value);
    }


    /**
     *
     * @return ImageFacet
     */
    public function getImage(){
        return $this->getProperty("image");
    }


    /**
     *
     * @param ImageFacet $value
     */
    public function setImage($value){
        $this->setProperty("image",$value);
    }



    function getTypeName()
    {
        return "#Microsoft.FileServices.File";
    }

}