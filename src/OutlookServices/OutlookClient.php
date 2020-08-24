<?php

namespace Office365\OutlookServices;


use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Runtime\Auth\OAuthTokenProvider;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\OData\ODataRequest;
use Office365\Runtime\Actions\UpdateEntityQuery;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\Office365Version;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\OData\JsonFormat;
use Office365\Runtime\OData\ODataMetadataLevel;
use Office365\Runtime\Http\RequestOptions;

/**
 * Outlook Services OData client
 */
class OutlookClient extends ClientRuntimeContext
{

    /**
     * @param string $tenant
     * @param callable $acquireToken
     * @param string $version
     */
    public function __construct($tenant, callable $acquireToken, $version = Office365Version::V1)
    {
        $this->version = $version;
        $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $tenant;
        $authContext = new AuthenticationContext($authorityUrl, $acquireToken);
        $this->getPendingRequest()->beforeExecuteRequest(function (RequestOptions $request){
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
        if(!isset($this->me))
            $this->me = new User($this,new ResourcePath("me"));
        return $this->me;
    }


    /**
     * @return UserCollection
     */
    public function getUsers(){
        if(!isset($this->users))
            $this->users = new UserCollection($this,new ResourcePath("Users"));
        return $this->users;
    }


    /**
     * @return GroupCollection
     */
    public function getGroups(){
        if(!isset($this->groups))
            $this->groups = new GroupCollection($this,new ResourcePath("Groups"));
        return $this->groups;
    }


    public function getServiceRootUrl()
    {
        return "https://outlook.office365.com/api/$this->version/";
    }


    /**
     * Service version
     * @var string
     */
    private $version;

    /**
     * @var ODataRequest
     */
    private $pendingRequest;


    /**
     * Gets the api version being used
     * @return string
     */
    public function getApiVersion()
    {
        return $this->version;
    }

    /**
     * @var User
     */
    private $me;


    /**
     * @var UserCollection
     */
    private $users;


    /**
     * @var GroupCollection
     */
    private $groups;

}

