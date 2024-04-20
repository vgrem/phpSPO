<?php

/**
 * Generated  2024-04-20T08:07:39+00:00 16.0.24803.12007
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
}