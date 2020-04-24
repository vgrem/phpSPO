<?php

/**
 * Updated By PHP Office365 Generator 2020-04-22T21:18:30+00:00 16.0.20008.12009
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
class SPListRule extends ClientValueObject
{
    /**
     * @var string
     */
    public $Condition;
    /**
     * @var string
     */
    public $ID;
    /**
     * @var bool
     */
    public $IsActive;
    /**
     * @var string
     */
    public $LastModifiedDate;
    /**
     * @var string
     */
    public $Outcome;
    /**
     * @var string
     */
    public $Title;
    /**
     * @var integer
     */
    public $TriggerType;
}