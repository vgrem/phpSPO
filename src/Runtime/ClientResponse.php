<?php


namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\OData\ODataFormat;

abstract class ClientResponse
{
    public function __construct($payload,$details)
    {
        $this->Payload = $payload;
        $this->StatusCode = $details['HttpCode'];
    }

    /**
     * @param IEntityType|ClientResult $object
     * @param ODataFormat $format
     */
    abstract  function map($object,$format);

    abstract function validate();

    protected $StatusCode;

    protected $Payload;

}
