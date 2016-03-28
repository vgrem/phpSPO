<?php

namespace SharePoint\PHP\Client;


/**
 * Web client object
 */
class Web extends ClientObject
{
 
    public function update($webUpdationInformation)
    {
        $this->payload = $webUpdationInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    public function deleteObject()
    {
        $qry = new ClientQuery($this,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }
   

    public function getLists()
    {
        if(!isset($this->Lists)){
            $this->Lists = new ListCollection($this->getContext(),"/_api/web/lists");
        }
        return $this->Lists;
    }

    public function getWebs()
    {
        if(!isset($this->Webs)){
            $this->Webs = new WebCollection($this->getContext(),"/_api/web/webs");
        }
        return $this->Webs;
    }


    public function getFileByUrl($serverRelativeUrl){
        $serverRelativeUrl = rawurlencode($serverRelativeUrl);
        $resPath = "/_api/web/getfilebyserverrelativeurl('$serverRelativeUrl')";
        $file = new File($this->getContext(),$resPath);
        $qry = new ClientQuery($file);
        $this->getContext()->addQuery($qry);
        return $file;
    }


}