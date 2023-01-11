<?php


namespace Office365\SharePoint\Search;


use Office365\Runtime\ClientValue;
use Office365\Runtime\ServerTypeInfo;

class SearchResult extends ClientValue
{

    /**
     * @return ServerTypeInfo
     */
    public function getServerTypeInfo()
    {
        return new ServerTypeInfo("Microsoft.Office.Server.Search.REST", "SearchResult");
    }

}