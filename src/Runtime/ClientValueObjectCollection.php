<?php

namespace SharePoint\PHP\Client;


class ClientValueObjectCollection extends ClientValueObject
{

    public function addChild(ClientValueObject $value)
    {
        if (is_null($this->data))
            $this->data = array();
        $this->data[] = $value;
    }


    /**
     * @var array
     */
    private $data = null;

    

}