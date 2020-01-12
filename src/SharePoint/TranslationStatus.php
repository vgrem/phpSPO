<?php

/**
 * Updated By PHP Office365 Generator 2020-01-12T21:42:50+00:00 16.0.19527.12070
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
class TranslationStatus extends ClientValueObject
{
    /**
     * @var string
     */
    public $Culture;
    /**
     * @var string
     */
    public $FileStatus;
    /**
     * @var bool
     */
    public $HasPublishedVersion;
    /**
     * @var string
     */
    public $LastModified;
    public $Path;
    /**
     * @var string
     */
    public $Title;
}