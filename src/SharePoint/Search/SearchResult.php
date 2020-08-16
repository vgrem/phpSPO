<?php


namespace Office365\SharePoint\Search;


use Office365\Runtime\ClientValue;

class SearchResult extends ClientValue
{


    public function getServerTypeName()
    {
        return "Microsoft.Office.Server.Search.REST.SearchResult";
    }

}