<?php


namespace Office365\SharePoint\Search;
use DateTime;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ResourcePath;
use Office365\SharePoint\BaseEntity;
use Office365\SharePoint\User;

/**
 * SearchService exposes search operations
 */
class SearchService extends BaseEntity
{

    public function __construct(ClientRuntimeContext $ctx)
    {
        parent::__construct($ctx,new ResourcePath("Microsoft.Office.Server.Search.REST.SearchService"));
    }


    /**
     * The operation is used by the administrator to retrieve the query log entries, issued after a specified date,
     * for a specified user.
     * @param string|User $user The name of the user that issued the queries.
     * @param DateTime $startTime The timestamp of the oldest query log entry returned.
     */
    public function export($user, $startTime){

        $createQuery = function ($userName) use ($startTime){
            $payload = array(
                "userName" => $userName,
                "startTime" => $startTime->format(DateTime::ISO8601)
            );
            return new InvokePostMethodQuery($this, "export",null,null, $payload);
        };

        $returnType = new ClientResult($this->getContext());

        if($user instanceof User){
            $user->ensureProperty("UserPrincipalName", function () use ($user, $createQuery, $returnType){
                $qry = $createQuery($user->getUserPrincipalName());
                $this->getContext()->addQueryAndResultObject($qry,$returnType);
            });
        }
        else{
            $qry = $createQuery($user);
            $this->getContext()->addQueryAndResultObject($qry,$returnType);
        }
        return $returnType;
    }

    /**
     * The operation is used to retrieve search results through the use of the HTTP protocol with method type POST.
     * @param SearchRequest $request
     * @return ClientResult
     */
    public function postQuery(SearchRequest $request){
        $returnType = new ClientResult($this->getContext(), new SearchResult());
        $qry = new InvokePostMethodQuery($this, "postquery",null,"request", $request);
        $this->getContext()->addQueryAndResultObject($qry,$returnType);
        return $returnType;
    }

}
