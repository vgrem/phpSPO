<?php

namespace Office365;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;


class EntityType extends Entity
{

    public function getObjectProperty()
    {
        return $this->getProperty("{name}",
            new ClientObject($this->getContext(),new ResourcePath("{name}",$this->getResourcePath())));
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
