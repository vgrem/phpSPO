<?php


namespace SharePoint\PHP\Client;


class ListCreationInformation extends ClientValueObject
{
    public $Title;

    public $Description;

    public $BaseTemplate;
    
    public $AllowContentTypes;

    public $ContentTypesEnabled;

    public function __construct($title)
    {
        $this->Title = $title;
        $this->Description = "";
        $this->BaseTemplate = 100;
        $this->AllowContentTypes = true;
        $this->ContentTypesEnabled = true;
    }
}