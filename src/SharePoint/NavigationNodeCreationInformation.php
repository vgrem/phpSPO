<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T15:45:50+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * Describes 
 * a new navigation node to be created.
 */
class NavigationNodeCreationInformation extends ClientValueObject
{
    /**
     * Gets or 
     * sets a Boolean value that specifies whether the navigation node will be created 
     * as the last node in the navigation node collection. Has no effect if PreviousNode 
     * is not null.
     * @var bool
     */
    public $AsLastNode;
    /**
     * Gets a 
     * Boolean value that specifies whether the navigation node URL can correspond to 
     * a page outside the site collection.
     * @var bool
     */
    public $IsExternal;
    /**
     * Gets or 
     * sets the string to be used as the anchor text for the node navigation link.Its length 
     * MUST be equal to or less than 256. 
     * @var string
     */
    public $Title;
    /**
     * Gets or 
     * sets the URL to be stored with the navigation node.
     * @var string
     */
    public $Url;
}