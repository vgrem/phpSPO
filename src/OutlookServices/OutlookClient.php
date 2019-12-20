<?php

namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\Office365Version;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\OData\JsonFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

/**
 * Outlook Services OData client
 */
class OutlookClient extends ClientRuntimeContext
{

    /**
     * OutlookClient constructor.
     * @param string $tenant
     * @param callable $acquireToken
     * @param string $version
     */
    public function __construct($tenant, callable $acquireToken, $version = Office365Version::V1)
    {
        $this->version = $version;
        $this->serviceRootUrl = $this->serviceRootUrl . $version . "/";
        $format = new JsonFormat(ODataMetadataLevel::Verbose);
        $format->addProperty("type","#Microsoft.OutlookServices.*");

        $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $tenant;
        $authContext = new AuthenticationContext($authorityUrl);
        call_user_func($acquireToken, $authContext);
        parent::__construct($this->serviceRootUrl, $authContext,$format, $version);
    }

    /**
     * Submits query to Outlook REST/OData service
     */
    public function executeQuery()
    {
        $this->getPendingRequest()->beforeExecuteQuery(function (RequestOptions $request,ClientAction $query){
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
     * @return User
     */
    public function getMe(){
        if(!isset($this->me))
            $this->me = new User($this,new ResourcePathEntity($this,null,"me"));
        return $this->me;
    }


    /**
     * @return UserCollection
     */
    public function getUsers(){
        if(!isset($this->users))
            $this->users = new UserCollection($this,new ResourcePathEntity($this,null,"Users"));
        return $this->users;
    }


    /**
     * @return GroupCollection
     */
    public function getGroups(){
        if(!isset($this->groups))
            $this->groups = new GroupCollection($this,new ResourcePathEntity($this,null,"Groups"));
        return $this->groups;
    }


    /**
     * @var string
     */
    private $serviceRootUrl = "https://outlook.office365.com/api/";
    //private $serviceRootUrl = "https://graph.microsoft.com/";

    /**
     * @var string
     */
    public $version;

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

