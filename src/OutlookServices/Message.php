<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionDeleteEntity;
use Office365\PHP\Client\Runtime\ClientActionUpdateEntity;
use Office365\PHP\Client\Runtime\ClientObject;

class Message extends ClientObject
{


    /**
     * Updates a Message resource
     */
    public function update()
    {
        $qry = new ClientActionUpdateEntity($this);
        $this->getContext()->addQuery($qry);
    }


    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }


    function setProperty($name, $value, $persistChanges = true)
    {
        if($name == "Id"){
            if(is_null($this->getResourcePath()))
                $this->setResourceUrl($this->parentCollection->getResourcePath()->toUrl() . "/" . $value);
            $this->{$name} = $value;
        }
        else
            parent::setProperty($name, $value, $persistChanges);
    }

    /**
     * @var ItemBody
     */
    public $Body;

    /**
     * @var string
     */
    public $Subject;


    public $Id;

}