<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:07:48+00:00 16.0.19402.12016
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
}