<?php


namespace SharePoint\PHP\Client\Runtime;


class ODataJsonFormat
{

    public function __construct($metadata)
    {
        $this->Metadata = $metadata;
    }

    public function buildHeaders(){
        return [
            "Accept" => "application/json; odata={$this->Metadata}",
            "Content-type" => "application/json; odata={$this->Metadata}"
        ];
    }

    /**
     * Controls information from the payload
     * @var string
     */
    public $Metadata;


    /**
     *  Gets/sets whether Edm.Int64 and Edm.Decimal numbers are represented as strings
     * @var bool
     */
    public $IEE754Compatible;
}