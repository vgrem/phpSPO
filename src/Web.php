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
        if(!isset($this->listCollection)){
            $this->listCollection = new ListCollection($this->getContext(),"/_api/web/lists");
        }
        return $this->listCollection;
    }

    public function getWebs()
    {
        if(!isset($this->webCollection)){
            $this->webCollection = new WebCollection($this->getContext(),"/_api/web/webs");
        }
        return $this->webCollection;
    }


    private $listCollection;

    private $webCollection;
}