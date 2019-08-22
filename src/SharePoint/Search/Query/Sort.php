<?php


namespace Office365\PHP\Client\SharePoint\Search\Query;


use Office365\PHP\Client\Runtime\ClientValueObject;

/**
 * Defines how search results are sorted.
 */
class Sort extends ClientValueObject
{
    /**
     * @var SortDirection
     * Gets or sets the direction in which search results are ordered.
     */
    public $Direction;


    /**
     * @var string
     * Gets or sets the name for a property by which the search results are ordered.
     */
    public $Property;

}
