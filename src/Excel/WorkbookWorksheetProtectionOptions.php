<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Excel;

use Office365\Runtime\ClientValue;
class WorkbookWorksheetProtectionOptions extends ClientValue
{
    /**
     * @var bool
     */
    public $AllowAutoFilter;
    /**
     * @var bool
     */
    public $AllowDeleteColumns;
    /**
     * @var bool
     */
    public $AllowDeleteRows;
    /**
     * @var bool
     */
    public $AllowFormatCells;
    /**
     * @var bool
     */
    public $AllowFormatColumns;
    /**
     * @var bool
     */
    public $AllowFormatRows;
    /**
     * @var bool
     */
    public $AllowInsertColumns;
    /**
     * @var bool
     */
    public $AllowInsertHyperlinks;
    /**
     * @var bool
     */
    public $AllowInsertRows;
    /**
     * @var bool
     */
    public $AllowPivotTables;
    /**
     * @var bool
     */
    public $AllowSort;
}