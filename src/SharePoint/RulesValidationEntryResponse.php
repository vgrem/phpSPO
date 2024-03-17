<?php

/**
 * Generated  2024-03-17T10:39:33+00:00 16.0.24628.12008
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class RulesValidationEntryResponse extends ClientValue
{
    /**
     * @var integer
     */
    public $Action;
    /**
     * @var string
     */
    public $BusinessJustification;
    /**
     * @var string
     */
    public $LastUpdatedDateTime;
    /**
     * @var ReviewerInfo
     */
    public $Reviewer;
    /**
     * @var RulesDefinition
     */
    public $Rule;
}