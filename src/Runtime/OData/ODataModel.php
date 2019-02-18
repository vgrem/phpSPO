<?php


namespace Office365\PHP\Client\Runtime\OData;


class ODataModel
{

    public function addType($name)
    {
        $this->types[$name] = [];
    }

    public  function getTypes(){
        return $this->types;
    }


    /**
     * @var array
     */
    private $types = null;
}