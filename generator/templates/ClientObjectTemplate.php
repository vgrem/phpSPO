<?php

namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePath;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;

class ClientObjectTemplate extends ClientObject
{

    public function getObjectProperty()
    {
        if(!$this->isPropertyAvailable("{name}")){
            $this->setProperty("{name}", new ClientObject($this->getContext(),
                new ResourcePath("{name}",$this->getResourcePath())));
        }
        return $this->getProperty("{name}");
    }

    public function getValueProperty()
    {
        if(!$this->isPropertyAvailable("{name}")){
            return null;
        }
        return $this->getProperty("{name}");
    }

    public function setValueProperty($value)
    {
        $this->setProperty("{name}",$value,true);
    }


    public function updateOperation()
    {
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQueryAndResultObject($qry,$this);
    }

    public function deleteOperation()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
        $this->removeFromParentCollection();
    }

}
