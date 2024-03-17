<?php

/**
 * Generated  2024-03-17T10:39:33+00:00 16.0.24628.12008
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class DocumentGenerationInfo extends ClientValue
{
    /**
     * @var string
     */
    public $FileName;
    /**
     * @var bool
     */
    public $IsTempFile;
    /**
     * @var string
     */
    public $TempFileUrl;
    /**
     * @var string
     */
    public $FolderUrl;
    /**
     * @var integer
     */
    public $Format;
    /**
     * @var array
     */
    public $ConditionalFieldsToBeDeleted;
    /**
     * @var bool
     */
    public $CopyFieldsFromExistingDocument;
}