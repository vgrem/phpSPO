<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Excel;

use Office365\Common\Json;
use Office365\Runtime\ClientValue;
class WorkbookFilterCriteria extends ClientValue
{
    /**
     * @var string
     */
    public $Color;
    /**
     * @var string
     */
    public $Criterion1;
    /**
     * @var string
     */
    public $Criterion2;
    /**
     * @var string
     */
    public $DynamicCriteria;
    /**
     * @var string
     */
    public $FilterOn;
    /**
     * @var string
     */
    public $Operator;
    /**
     * @var Json
     */
    public $Values;
    /**
     * @var WorkbookIcon
     */
    public $Icon;
}