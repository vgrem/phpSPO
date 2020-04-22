<?php


namespace Office365\SharePoint;
use Office365\Runtime\ClientValueObject;


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