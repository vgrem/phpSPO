<?php


namespace Office365\Runtime\OData;


/**
 * Represents the OData raw query values in the string format from the incoming request.
 */
class ODataQueryOptions
{

    public function clear(){
        foreach ($this->getProperties() as $k => $v) {
            $this->$k = null;
        }
    }

    /**
     * @return bool
     */
    public function isEmpty(){
        return (count($this->getProperties()) == 0);
    }

    /**
     * @return string
     */
    public function toUrl()
    {
        return implode('&',array_map(
                function ($key,$val) {
                    $key = "\$" . strtolower($key);
                    return "$key=$val";
                },array_keys($this->getProperties()),$this->getProperties())
        );
    }


    /**
     * @return array
     */
    private function getProperties(){
        return array_filter((array) $this);
    }

    /**
     * @var string
     */
    public $Select;

    /**
     * @var string
     */
    public $Filter;

    /**
     * @var string
     */
    public $Expand;

    /**
     * @var string
     */
    public $OrderBy;

    /**
     * @var int
     */
    public $Top;

    /**
     * @var int
     */
    public $Skip;

    /**
     * @var string
     */
    public $SkipToken;

    /**
     * @var string
     */
    public $Search;
}