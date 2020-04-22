<?php


namespace Office365\SharePoint\Search\Query;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\InvokePostMethodQuery;
use Office365\Runtime\ResourcePath;

/**
 * Executes queries against a search server.
 */
class SearchExecutor extends ClientObject
{

    public function __construct(ClientRuntimeContext $ctx)
    {
        parent::__construct($ctx,new ResourcePath("search"));
    }

    /**
     * Runs a query.
     * @param Query $query
     * @return ClientResult
     */
    public function executeQuery (Query $query){
        $result = new ClientResult();
        $qry = new InvokePostMethodQuery($this, "postquery",null,null, $query);
        $this->getContext()->addQueryAndResultObject($qry,$result);
        return $result;
    }

}
