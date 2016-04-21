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
        $this->Description = $title;
        $this->BaseTemplate = ListTemplateType::GenericList;
        $this->AllowContentTypes = true;
        $this->ContentTypesEnabled = true;
    }
}