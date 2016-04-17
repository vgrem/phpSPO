<?php

namespace SharePoint\PHP\Client;


/**
 * Represents metadata about site creation.
 */
class WebCreationInformation
{

    /**
     * The description of the site.
     */
    public $Description;

    /**
     * The title of the site.
     */
    public $Title;


    /**
     * A valid language code identifier (LCID) of the language to use on the site.
     */
    public $Language;

    /**
     * The URL of the site.
     */
    public $Url;


    /**
     * Indicates whether the site inherits permissions from its parent.
     */
    public $UseUniquePermissions;


    /**
     * The name of the site template that is used to create the site.
     */
    public $WebTemplate;


    public function __construct($url,$title)
    {
        $this->Url = $url;
        $this->Title = $title;
        $this->Description = $title;
        $this->Language = 1033;
        $this->WebTemplate = "STS";
        $this->UseUniquePermissions = false;
    }

}