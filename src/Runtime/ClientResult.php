<?php


namespace SharePoint\PHP\Client;


/**
 * Represents a primitive property value.
 */
class ClientResult
{


    function __construct($functionImport)
    {
        $this->FunctionName = $functionImport;
    }


    /**
     * @var string
     */
    public $FunctionName;

    /**
     * @var string
     */
    public $Value;
}