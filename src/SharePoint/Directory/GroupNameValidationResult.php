<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:32:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Directory;

use Office365\PHP\Client\Runtime\ClientValueObject;

class GroupNameValidationResult extends ClientValueObject
{
    /**
     * @var GroupNameValidationResultErrorParams
     */
    public $AliasErrorDetails;
    /**
     * @var GroupNameValidationResultErrorParams
     */
    public $DisplayNameErrorDetails;
    /**
     * @var string
     */
    public $ErrorCode;
    /**
     * @var string
     */
    public $ErrorMessage;
    /**
     * @var bool
     */
    public $IsValidName;
}
