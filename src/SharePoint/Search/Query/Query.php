<?php


namespace Office365\SharePoint\Search\Query;


use Office365\Runtime\ClientObject;

/**
 * Contains information common to all types of search queries.
 */
class Query extends ClientObject
{

    /**
     * The query text of the search query.
     * @var string
     */
    public $QueryText;

}
