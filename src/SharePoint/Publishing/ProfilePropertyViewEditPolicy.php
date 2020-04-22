<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:41:09+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientValueObject;

class ProfilePropertyViewEditPolicy extends ClientValueObject
{
    /**
     * @var bool
     */
    public $IsDisabled;
    /**
     * @var bool
     */
    public $IsRequired;
    /**
     * @var bool
     */
    public $IsTaxonomic;
    /**
     * @var bool
     */
    public $IsUserEditable;
    /**
     * @var bool
     */
    public $IsVisibleOnEditor;
    /**
     * @var integer
     */
    public $Privacy;
    /**
     * @var bool
     */
    public $UserOverridePrivacy;
}