<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
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
    /**
     * @var string
     */
    public $CreateDate;
    /**
     * @var integer
     */
    public $ActionType;
    /**
     * @var string
     */
    public $ActionParams;
    /**
     * @var string
     */
    public $RuleTemplateId;
    /**
     * @var SPRuleUserInfo
     */
    public $LastModifiedBy;
}