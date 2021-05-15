<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class MessageRuleActions extends ClientValue
{
    /**
     * @var string
     */
    public $MoveToFolder;
    /**
     * @var string
     */
    public $CopyToFolder;
    /**
     * @var bool
     */
    public $Delete;
    /**
     * @var bool
     */
    public $PermanentDelete;
    /**
     * @var bool
     */
    public $MarkAsRead;
    /**
     * @var array
     */
    public $AssignCategories;
    /**
     * @var bool
     */
    public $StopProcessingRules;
}