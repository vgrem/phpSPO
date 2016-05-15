<?php


namespace SharePoint\PHP\Client;


class ListCreationInformation extends ClientValueObject
{
    /**
     * @var string
     */
    public $Title;


    /**
     * @var string
     */
    public $Description;

    /**
     * @var ListTemplateType
     */
    public $BaseTemplate;

    /**
     * @var bool
     */
    public $AllowContentTypes;

    /**
     * @var bool
     */
    public $ContentTypesEnabled;

    public function __construct($title)
    {
        $this->Title = $title;
        $this->Description = $title;
        $this->BaseTemplate = ListTemplateType::GenericList;
        $this->AllowContentTypes = true;
        $this->ContentTypesEnabled = true;
        $this->setMetadataType("SP.List");
    }
    
}