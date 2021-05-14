<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class LookupColumn extends ClientValue
{
    /**
     * @var bool
     */
    public $AllowMultipleValues;
    /**
     * @var bool
     */
    public $AllowUnlimitedLength;
    /**
     * @var string
     */
    public $ColumnName;
    /**
     * @var string
     */
    public $ListId;
    /**
     * @var string
     */
    public $PrimaryLookupColumnId;
}