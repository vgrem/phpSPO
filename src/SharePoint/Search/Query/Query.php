<?php


namespace Office365\PHP\Client\SharePoint\Search\Query;


use Office365\PHP\Client\Runtime\ClientObject;

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
