<?php

namespace Office365\SharePoint;
use Office365\Runtime\ClientObject;
use Office365\Runtime\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\UpdateEntityQuery;

class EntityType extends ClientObject
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
