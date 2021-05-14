<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Excel;

use Office365\Runtime\ClientValue;
class WorkbookSortField extends ClientValue
{
    /**
     * @var bool
     */
    public $Ascending;
    /**
     * @var string
     */
    public $Color;
    /**
     * @var string
     */
    public $DataOption;
    /**
     * @var WorkbookIcon
     */
    public $Icon;
    /**
     * @var integer
     */
    public $Key;
    /**
     * @var string
     */
    public $SortOn;
}