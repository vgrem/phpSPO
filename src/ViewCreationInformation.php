<?php


namespace SharePoint\PHP\Client;

/**
 * Specifies the properties used to create a new list view.
 */
class ViewCreationInformation
{
    /**
     * The title of the view.
     */
    public $Title;

    public $Paged;

    public $PersonalView;

    public $Query;

    public $RowLimit;

    public $SetAsDefaultView;

    public $ViewFields;

    public $ViewTypeKind;


    public function __construct()
    {
        $this->RowLimit = 30;
    }

}