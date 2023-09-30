<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
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
}