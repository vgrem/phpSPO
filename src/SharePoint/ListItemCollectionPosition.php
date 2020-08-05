<?php


namespace Office365\SharePoint;


use Office365\Runtime\ClientValue;

class ListItemCollectionPosition extends ClientValue
{
    /**
     * Gets or sets a value that specifies information, as name-value pairs, 
     * required to get the next page of data for a list view.
     * @var string
     */
    public $PagingInfo;
}