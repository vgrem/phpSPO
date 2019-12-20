<?php

namespace Office365\PHP\Client\GraphClient;

use Office365\PHP\Client\OneDrive\CurrentUserRequestContext;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\OData\JsonFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\Office365Version;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

class GraphServiceClient extends ClientRuntimeContext
{
    public function __construct($tenant, callable $acquireToken)
    {
        $serviceRootUrl = "https://graph.microsoft.com/" . Office365Version::V1 . "/";
        $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $tenant;
        $authContext = new AuthenticationContext($authorityUrl);
        call_user_func($acquireToken, $authContext);
        parent::__construct($serviceRootUrl, $authContext,new JsonFormat(ODataMetadataLevel::Verbose));
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
            $this->me = new CurrentUserRequestContext($this,new ResourcePathEntity($this,null,"me"));
        return $this->me;
    }





}
