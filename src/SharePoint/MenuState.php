<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T15:42:43+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * A menu 
 * tree which can be shown in the Quick Launch of a site (2).
 */
class MenuState extends ClientValueObject
{
    /**
     * @var array
     */
    public $AudienceIds;
    /**
     * Specifies 
     * the site 
     * collection relative URL for the root 
     * node of the menu tree.
     * @var string
     */
    public $FriendlyUrlPrefix;
    /**
     * Read/WriteThe child 
     * nodes of the root node of the menu tree.
     * @var array
     */
    public $Nodes;
    /**
     * If the NodeType 
     * property (section 3.2.5.244.1.1.7) of 
     * the menu tree root node is set to "SimpleLink", this property 
     * represents the URL of the root 
     * node. The URL can be relative or absolute. If the value is a relative URL, it 
     * can begin with URL tokens "~site" and "~sitecollection". 
     * These tokens indicate that the URL is either relative to the site (2) 
     * or to the site collection 
     * respectively. If the NodeType property (section 3.2.5.244.1.1.7) of the 
     * menu tree root node is not set to "SimpleLink", this value MUST be 
     * NULL.
     * @var string
     */
    public $SimpleUrl;
    /**
     * Defines 
     * the text that SHOULD be substituted for "~sitecollection/" in 
     * relative links (such as "~sitecollection/Pages/MyPage.aspx ").
     * @var string
     */
    public $SPSitePrefix;
    /**
     * Defines 
     * the text that SHOULD be substituted for "~site/" in relative links 
     * (such as "~site/Pages/MyPage.aspx").
     * @var string
     */
    public $SPWebPrefix;
    /**
     * Specifies 
     * the identifier for the root node in the menu tree.
     * @var string
     */
    public $StartingNodeKey;
    /**
     * Specifies 
     * the title of the root node in the menu tree.
     * @var string
     */
    public $StartingNodeTitle;
    /**
     * Specifies 
     * an implementation-specific value that the protocol server uses to detect 
     * external changes.
     * @var string
     */
    public $Version;
}