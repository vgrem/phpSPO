<?php


namespace Office365\SharePoint\Search;


use Office365\Runtime\ClientValue;
use Office365\Runtime\ServerTypeInfo;

class SearchRequest extends ClientValue
{

    /**
     * @return ServerTypeInfo
     */
    public function getServerTypeInfo()
    {
        return new ServerTypeInfo("Microsoft.Office.Server.Search.REST", "SearchRequest");
    }

    /**
     * The query text of the search query. If this element is not present or a value is not specified, a default
     * value of an empty string MUST be used, and the server MUST return a FaultException<ExceptionDetail> message.
     * @var string
     */
    public $Querytext;

    /**
     * Specifies the identifier of the language culture of the search query. If present, the value MUST be a valid
     * language code identifier (LCID) of a culture name, as specified in [RFC3066]
     * @var int
     */
    public $Culture;

}
