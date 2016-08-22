<?php


namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataPayload;
use SharePoint\PHP\Client\Runtime\ODataPayloadKind;

/**
 * Represents properties that can be set when creating a file by using the FileCollection.Add method.
 */
class FileCreationInformation extends ClientValueObject
{

    function __construct()
    {
        parent::__construct();
        $this->Overwrite = true;
    }



    function convertToPayload()
    {
        return new ODataPayload($this->Content,ODataPayloadKind::Property,$this->getEntityTypeName());
    }

    /**
     * @var string
     */
    public $Url;

    /**
     * @var string
     */
    public $Content;

    /**
     * @var bool
     */
    public $Overwrite;


}