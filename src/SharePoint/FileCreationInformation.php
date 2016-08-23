<?php


namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\OData\ODataPayloadKind;


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