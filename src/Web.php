<?php

namespace SharePoint\PHP\Client;


/**
 * Web client object
 */
class Web extends ClientObject
{
    public function __construct($context)
    {
        parent::__construct($context);
    }
   

    public function getLists()
    {
        if(!isset($this->listCollection)){
            $this->listCollection = new ListCollection($this->getContext());
        }
        return $this->listCollection;
    }



    private $listCollection;
}