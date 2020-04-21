<?php

namespace Office365\PHP\Client\GraphClient;

use Office365\PHP\Client\OneDrive\CurrentUserRequestContext;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\Http\HttpMethod;
use Office365\PHP\Client\Runtime\OData\JsonFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\OData\ODataRequest;
use Office365\PHP\Client\Runtime\Office365Version;
use Office365\PHP\Client\Runtime\ResourcePath;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\Http\RequestOptions;

class GraphServiceClient extends ClientRuntimeContext
{
    /**
     * @var ODataRequest $pendingRequest
     */
    private $pendingRequest;

    public function __construct($tenant, callable $acquireToken)
    {
        $serviceRootUrl = "https://graph.microsoft.com/" . Office365Version::V1 . "/";
        $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $tenant;
        $authContext = new AuthenticationContext($authorityUrl);
        call_user_func($acquireToken, $authContext);
        parent::__construct($serviceRootUrl, $authContext,new JsonFormat(ODataMetadataLevel::Verbose));
    }


    /**
     * @return ODataRequest
     */
    function getPendingRequest()
    {
        if(!$this->pendingRequest){
            $format = new JsonFormat(ODataMetadataLevel::Verbose);
            $this->pendingRequest = new ODataRequest($this,$format);
        }
        return $this->pendingRequest;
    }


    public function executeQuery()
    {
        $this->getPendingRequest()->beforeExecuteQuery(
            function (RequestOptions $request,ClientAction $query){
                $this->prepareRequest($request,$query);
            });
        parent::executeQuery();
    }

    private function prepareRequest(RequestOptions $request,ClientAction $query)
    {
        //set data modification headers
        if ($query instanceof UpdateEntityQuery) {
            $request->Method = HttpMethod::Patch;
        } else if ($query instanceof DeleteEntityQuery) {
            $request->Method = HttpMethod::Delete;
        }
    }

    /**
     * @return CurrentUserRequestContext
     */
    public function getMe(){
        if(!isset($this->me))
            $this->me = new CurrentUserRequestContext($this,new ResourcePath("me"));
        return $this->me;
    }



}
