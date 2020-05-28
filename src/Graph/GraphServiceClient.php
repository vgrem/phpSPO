<?php

namespace Office365\Graph;

use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Runtime\Auth\OAuthTokenProvider;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\DeleteEntityQuery;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\OData\JsonFormat;
use Office365\Runtime\OData\ODataMetadataLevel;
use Office365\Runtime\OData\ODataRequest;
use Office365\Runtime\Office365Version;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\UpdateEntityQuery;
use Office365\Runtime\Http\RequestOptions;

class GraphServiceClient extends ClientRuntimeContext
{

    /**
     * GraphServiceClient constructor.
     * @param string $tenant
     * @param callable $acquireToken
     */
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
            function (RequestOptions $request){
                $this->prepareRequest($request);
            });
        parent::executeQuery();
    }

    private function prepareRequest(RequestOptions $request)
    {
        $query = $this->pendingRequest->getCurrentQuery();
        //set data modification headers
        if ($query instanceof UpdateEntityQuery) {
            $request->Method = HttpMethod::Patch;
        } else if ($query instanceof DeleteEntityQuery) {
            $request->Method = HttpMethod::Delete;
        }
    }

    /**
     * @return User
     */
    public function getMe(){
        return new User($this,new ResourcePath("me"));
    }

    /**
     * @return DriveCollection
     */
    public function getDrives(){
        return new DriveCollection($this,new ResourcePath("drives"));
    }

    /**
     * @var ODataRequest $pendingRequest
     */
    private $pendingRequest;

}
