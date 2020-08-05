<?php

/**
 * Updated By PHP Office365 Generator 2020-05-24T09:54:07+00:00 16.0.20113.12008
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class SPListRule extends ClientValue
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
    /**
     * @var string
     */
    public $Owner;
}