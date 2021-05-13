<?php

namespace Office365;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;


class EntityType extends Entity
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
        return $this->getProperty("{name}");
    }

    public function setValueProperty($value)
    {
        return $this->setProperty("{name}",$value,true);
    }

}
