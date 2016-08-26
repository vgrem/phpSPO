<?php

namespace Office365\PHP\Client\Runtime;


class ClientValueObjectCollection extends ClientValueObject
{

    /**
     * @param ClientValueObject $value
     */
    public function addChild(ClientValueObject $value)
    {
        if (is_null($this->data))
            $this->data = array();
        $this->data[] = $value;
    }


    /**
     * Clear collection
     */
    public function clearData()
    {
        $this->data = array();
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->data);
    }


    /**
     * Creates entity for a collection
     * @return ClientValueObject
     */
    public function createTypedValueObject()
    {
        $clientValueObjectType = $this->getItemTypeName();
        return new $clientValueObjectType();
    }

    /**
     * @return string
     */
    function getItemTypeName()
    {
        return str_replace("Collection","",get_class($this));
    }


    /**
     * @var array
     */
    private $data = null;

    

}