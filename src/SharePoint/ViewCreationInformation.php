<?php

/**
 * Updated By PHP Office365 Generator 2020-05-13T12:20:55+00:00 16.0.20029.12010
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
/**
 * Specifies 
 * the properties used to create a new list view.
 */
class ViewCreationInformation extends ClientValueObject
{
    /**
     * @var string
     */
    public $Title;
    /**
     * @var bool
     */
    public $Paged;
    /**
     * @var string
     */
    public $PersonalView;
    /**
     * @var string
     */
    public $Query;
    /**
     * @var int
     */
    public $RowLimit;
    /**
     * @var bool
     */
    public $SetAsDefaultView;
    /**
     * @var string
     */
    public $ViewFields;
    /**
     * @var int
     */
    public $ViewTypeKind;
    public function __construct()
    {
        $this->RowLimit = 30;
        parent::__construct("View");
    }
    public $baseViewId;
    /**
     * @var string
     */
    public $ViewData;
    /**
     * @var string
     */
    public $ViewType2;
}