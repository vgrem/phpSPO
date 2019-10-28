<?php


use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class ClientObjectTemplate extends ClientObject
{

    public function getObjectProperty()
    {
        if(!$this->isPropertyAvailable("{name}")){
            $this->setProperty("{name}", new ClientObject($this->getContext(),
                new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"{name}")));
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


}
