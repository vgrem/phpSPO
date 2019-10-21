<?php


namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\OData\ODataFormat;

abstract class ClientResponse
{
    public function __construct($content, $details)
    {
        $this->Content = $content;
        $this->StatusCode = $details['HttpCode'];
    }

    public function getContent(){
        return $this->Content;
    }

    /**
     * @param IEntityType|ClientResult $object
     * @param ODataFormat $format
     */
    abstract  function map($object,$format);

    /**
     * @return bool
     */
    abstract function validate();

    /**
     * @var integer
     */
    protected $StatusCode;


    protected $Content;

}
