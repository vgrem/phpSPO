<?php

/**
 * Generated  2025-08-23T09:07:29+00:00 16.0.26406.12013
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class FileVersionBatchDeleteParameters extends ClientValue
{
    /**
     * @var integer
     */
    public $BatchDeleteMode;
    /**
     * @var integer
     */
    public $DeleteOlderThanDays;
    /**
     * @var integer
     */
    public $MajorVersionLimit;
    /**
     * @var integer
     */
    public $MajorWithMinorVersionsLimit;
    /**
     * @var bool
     */
    public $SyncListPolicy;
    /**
     * @var VersionPolicySelectionParameters
     */
    public $FileTypeSelections;
}