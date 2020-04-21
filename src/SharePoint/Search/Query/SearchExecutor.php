<?php


namespace Office365\PHP\Client\SharePoint\Search\Query;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ResourcePath;

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
