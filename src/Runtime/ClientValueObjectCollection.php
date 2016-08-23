<?php

namespace Office365\PHP\Client\Runtime;


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