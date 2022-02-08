<?php


namespace Office365\SharePoint\Search;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ResourcePath;
use Office365\SharePoint\BaseEntity;

/**
 * Executes queries against a search server.
 */
class SearchService extends BaseEntity
{

    public function __construct(ClientRuntimeContext $ctx)
    {
        parent::__construct($ctx,new ResourcePath("Microsoft.Office.Server.Search.REST.SearchService"));
    }

    /**
     * Constructs a search query.
     * @param SearchRequest $request
     * @return ClientResult
     */
    public function postQuery(SearchRequest $request){
        $result = new ClientResult($this->getContext(), new SearchResult());
        $qry = new InvokePostMethodQuery($this, "postquery",null,"request", $request);
        $this->getContext()->addQueryAndResultObject($qry,$result);
        return $result;
    }

}
