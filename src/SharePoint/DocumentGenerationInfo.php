<?php

/**
 * Generated  2024-04-20T08:07:39+00:00 16.0.24803.12007
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
    /**
     * @var bool
     */
    public $UpdateFolderPermissions;
}