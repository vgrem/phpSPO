<?php

/**
 * Updated By PHP Office365 Generator 2019-10-05T21:25:07+00:00 
*/
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class ListCreationInformation extends ClientValue
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
        parent::__construct("List");
    }
    public $CustomSchemaXml;
    public $DataSourceProperties;
    public $DocumentTemplateType;
    public $QuickLaunchOption;
    public $TemplateFeatureId;
    public $TemplateType;
    public $Url;
}