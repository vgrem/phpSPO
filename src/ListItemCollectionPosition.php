<?php


namespace SharePoint\PHP\Client;


class ListItemCollectionPosition extends ClientValueObject
{
    /**
     * Gets or sets a value that specifies information, as name-value pairs, 
     * required to get the next page of data for a list view.
     * @var string
     */
    public $PagingInfo;
}