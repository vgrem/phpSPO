<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:31:06+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Directory;

use Office365\Runtime\ClientValueObject;

class GroupNameValidationResultErrorParams extends ClientValueObject
{
    /**
     * @var string
     */
    public $BlockedWord;
    /**
     * @var string
     */
    public $Prefix;
    /**
     * @var string
     */
    public $Suffix;
    /**
     * @var string
     */
    public $ValidationErrorCode;
    /**
     * @var string
     */
    public $ValidationErrorMessage;
    /**
     * @var string
     */
    public $ValidationPropertyName;
}