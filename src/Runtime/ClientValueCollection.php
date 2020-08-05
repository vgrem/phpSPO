<?php

namespace Office365\Runtime;


class ClientValueCollection extends ClientValue
{

    /**
     * Adds property to collection
     * @param ClientValue $value
     */
    public function addChild($value)
    {
        if (is_null($this->data))
            $this->data = array();
        $this->data[] = $value;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
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
     * @return ClientValue
     */
    public function createType()
    {
        $clientValueType = $this->getItemTypeName();
        return new $clientValueType();
    }


    /**
     * @return string
     */
    function getItemTypeName()
    {
        return str_replace("Collection","",get_class($this));
    }

    function toJson()
    {
        return array_map(function (ClientValue $item) {
            return $item->toJson();
        }, $this->getData());
    }

    /**
     * @var array
     */
    private $data = null;

}
