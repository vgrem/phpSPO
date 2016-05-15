<?php


namespace SharePoint\PHP\Client;

/**
 * Specifies a Collaborative Application Markup Language (CAML) query on a list or joined lists.
 */
class CamlQuery extends ClientValueObject
{

    function __construct()
    {
    }

    public function toJson($rootElement='query')
    {
        return parent::toJson($rootElement);
    }
    
    /**
     * Gets or sets a value that indicates whether the query returns dates in Coordinated Universal Time (UTC) format.
     * @var \DateTime
     */
    public $DatesInUtc;

    /**
     * Gets or sets a value that specifies the server relative URL of a list folder from which results will be returned.
     * @var string
     */
    public $FolderServerRelativeUrl;

    /**
     * Gets or sets a value that specifies the information required to get the next page of data for the list view.
     * @var ListItemCollectionPosition
     */
    public $ListItemCollectionPosition;

    
    /**
     * Gets or sets value that specifies the XML schema that defines the list view.
     * @var string
     */
    public $ViewXml;

}