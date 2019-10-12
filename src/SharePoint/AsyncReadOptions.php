<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:45:59+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;

class AsyncReadOptions extends ClientValueObject
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
}