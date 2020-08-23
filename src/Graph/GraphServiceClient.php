<?php

namespace Office365\Graph;

use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Runtime\Auth\OAuthTokenProvider;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\OData\JsonFormat;
use Office365\Runtime\OData\ODataMetadataLevel;
use Office365\Runtime\OData\ODataRequest;
use Office365\Runtime\Office365Version;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
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
        $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $tenant;
        $authContext = new AuthenticationContext($authorityUrl, $acquireToken);
        $this->getPendingRequest()->beforeExecuteRequest(function (RequestOptions $request) {
            $this->prepareRequest($request);
        });
        parent::__construct($authContext);
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


    /**
     * Prepare MicrosoftGraph request
     * @param RequestOptions $request
     */
    private function prepareRequest(RequestOptions $request)
    {
        $query = $this->getCurrentQuery();
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
     * Retrieve the properties and relationships of user object.
     * @param string|null $userPrincipalNameOrId
     * @return UserCollection
     */
    public function getUsers($userPrincipalNameOrId=null){
        if(is_null($userPrincipalNameOrId))
            return new UserCollection($this,new ResourcePath($userPrincipalNameOrId,new ResourcePath("users")));
        return new UserCollection($this,new ResourcePath("users"));
    }


    /**
     * @return string
     */
    public function getServiceRootUrl()
    {
        return "https://graph.microsoft.com/" . Office365Version::V1 . "/";
    }


    /**
     * @var ODataRequest $pendingRequest
     */
    private $pendingRequest;

}
