<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Translation;

use Office365\PHP\Client\Runtime\ClientValueObject;

class TranslationJobInfo extends ClientValueObject
{
    /**
     * @var bool
     */
    public $Canceled;
    /**
     * @var string
     */
    public $CancelTime;
    /**
     * @var string
     */
    public $JobId;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var bool
     */
    public $PartiallySubmitted;
    /**
     * @var string
     */
    public $SubmittedTime;
}