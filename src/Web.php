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


    public function getFields()
    {
        if(!isset($this->Fields)){
            $this->Fields = new FieldCollection($this->getContext(),"/_api/web/fields");
        }
        return $this->Fields;
    }


    public function getSiteUsers()
    {
        if(!isset($this->SiteUsers)){
            $this->SiteUsers = new UserCollection($this->getContext(),"/_api/web/siteusers");
        }
        return $this->SiteUsers;
    }



    public function getFileByUrl($serverRelativeUrl){
        $encServerRelativeUrl = rawurlencode($serverRelativeUrl);
        $resPath = "/_api/web/getfilebyserverrelativeurl('$encServerRelativeUrl')";
        $file = new File($this->getContext(),$resPath);
        $qry = new ClientQuery($file);
        $this->getContext()->addQuery($qry);
        return $file;
    }


}