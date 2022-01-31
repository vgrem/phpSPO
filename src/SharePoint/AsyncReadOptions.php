<?php

/**
 * Generated 2022-01-31T19:42:54+02:00 16.0.22112.12004
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class AsyncReadOptions extends ClientValue
{
    /**
     * @var bool
     */
    public $IncludeDirectDescendantsOnly;
    /**
     * @var bool
     */
    public $IncludeExtendedMetadata;
    /**
     * @var bool
     */
    public $IncludeSecurity;
    /**
     * @var bool
     */
    public $IncludeVersions;
    /**
     * @var string
     */
    public $StartChangeToken;
    /**
     * @var bool
     */
    public $IncludePermission;
}