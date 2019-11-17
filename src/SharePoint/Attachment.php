<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T14:36:24+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ClientObject;
/**
 * Specifies 
 * a list 
 * item attachment.<174>
 */
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
    public function getFileName()
    {
        return $this->getProperty("FileName");
    }
    /**
     * @return string
     */
    public function getServerRelativeUrl()
    {
        return $this->getProperty("ServerRelativeUrl");
    }
    /**
     * Specifies 
     * the file name of the list item attachment.
     * @var string
     */
    public function setFileName($value)
    {
        $this->setProperty("FileName", $value, true);
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of a list item attachment.
     * @var string
     */
    public function setServerRelativeUrl($value)
    {
        $this->setProperty("ServerRelativeUrl", $value, true);
    }
}