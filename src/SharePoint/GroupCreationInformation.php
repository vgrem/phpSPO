<?php


namespace Office365\SharePoint;
use Office365\Runtime\ClientValue;
use Office365\Runtime\ServerTypeInfo;

/**
 * An object used to facilitate creation of a cross-site group.
 */
class GroupCreationInformation extends ClientValue
{
    /**
     * Gets or sets a string that contains the description of the group to be created.
     */
    public $Description;

    /**
     * Gets or sets a string that contains the name of the group to be created.
     */
    public $Title;


    public function __construct($title)
    {
        $this->Title = $title;
        $this->Description = "";
        parent::__construct();
    }

    /**
     * @return ServerTypeInfo
     */
    public function getServerTypeInfo()
    {
        return new ServerTypeInfo("SP", "Group");
    }

}