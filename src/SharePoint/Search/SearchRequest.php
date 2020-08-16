<?php


namespace Office365\SharePoint\Search;


use Office365\Runtime\ClientValue;

class SearchRequest extends ClientValue
{

    /**
     * @return string
     */
    public function getServerTypeName()
    {
        return "Microsoft.Office.Server.Search.REST.SearchRequest";
    }

    /**
     * @var string
     */
    public $Querytext;

    /**
     * @var int
     */
    public $Culture;

}
