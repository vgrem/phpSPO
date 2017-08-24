<?php


namespace Office365\PHP\Client\SharePoint;


use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ClientObject;

class Attachment extends ClientObject
{

    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }


    /**
     * @return string
     */
    public function getFileName(){
        return $this->getProperty("FileName");
    }


    /**
     * @return string
     */
    public function getServerRelativeUrl(){
        return $this->getProperty("ServerRelativeUrl");
    }

}