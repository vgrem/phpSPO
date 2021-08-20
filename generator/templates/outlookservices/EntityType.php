<?php

namespace Office365\Outlook;
use Office365\Entity;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;


class EntityType extends Entity
{

    public function getObjectProperty()
    {
        return $this->getProperty("{name}",
            new ClientObject($this->getContext(), new ResourcePath("{name}",$this->getResourcePath())));
    }

    public function getValueProperty()
    {
        return $this->getProperty("{name}", null);
    }

    public function setValueProperty($value)
    {
        return $this->setProperty("{name}",$value,true);
    }

}
