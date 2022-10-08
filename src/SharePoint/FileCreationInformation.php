<?php

/**
 * Generated  2022-10-08T10:32:22+03:00 16.0.22921.12007
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
/**
 * Represents properties that can be set when creating a file by using the FileCollection.Add method.
 */
class FileCreationInformation extends ClientValue
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
    /**
     * @var string
     */
    public $XorHash;
}