<?php

namespace Office365;


use Office365\Common\Application;
use Office365\Common\Group;
use Office365\Common\GroupSetting;
use Office365\Common\OrgContact;
use Office365\Common\User;
use Office365\Common\UserCollection;
use Office365\OneDrive\DriveCollection;
use Office365\OneDrive\DriveItem;
use Office365\OneDrive\Site;
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
use Office365\Teams\TeamCollection;


/**
 * The Microsoft Graph client is intended to make calls to Microsoft Graph API
 */
class GraphServiceClient extends ClientRuntimeContext
{

    /**
     * Graph Client.
     * @param callable $acquireToken
     */
    public function __construct(callable $acquireToken)
    {
        $this->acquireTokenFunc = $acquireToken;
        $this->getPendingRequest()->beforeExecuteRequest(function (RequestOptions $request) {
            $this->prepareRequest($request);
        });
        parent::__construct();
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
     * @return EntityCollection
     */
    public function getSites(){
        return new EntityCollection($this,new ResourcePath("sites"),Site::class);
    }

    /**
     * @return DriveCollection
     */
    public function getDrives(){
        return new DriveCollection($this,new ResourcePath("drives"));
    }


    /**
     * @return EntityCollection
     */
    public function getApplications(){
        return new EntityCollection($this,new ResourcePath("applications"),Application::class);
    }


    /**
     * Retrieve the properties and relationships of user object.
     * @return UserCollection
     */
    public function getUsers(){
        return new UserCollection($this,new ResourcePath("users"));
    }

    /**
     * @return EntityCollection
     */
    public function getGroups(){
        return new EntityCollection($this,new ResourcePath("groups"), Group::class);
    }

    /**
     * @return EntityCollection
     */
    public function getGroupSettings(){
        return new EntityCollection($this,new ResourcePath("groupSettings"), GroupSetting::class);
    }

    /**
     * @return TeamCollection
     */
    public function getTeams(){
        return new TeamCollection($this,new ResourcePath("teams"));
    }

    /**
     * @return EntityCollection
     */
    public function getContact(){
        return new EntityCollection($this,new ResourcePath("contacts"),OrgContact::class);
    }


    /**
     * @return EntityCollection
     */
    public function getWorkbooks(){
        return new EntityCollection($this,new ResourcePath("workbooks"),DriveItem::class);
    }

    /**
     * @return string
     */
    public function getServiceRootUrl()
    {
        return "https://graph.microsoft.com/" . Office365Version::V1 . "/";
    }

    public function authenticateRequest(RequestOptions $options)
    {
        $token = call_user_func($this->acquireTokenFunc, $this);
        $headerVal = $token['token_type'] . ' ' . $token['access_token'];
        $options->ensureHeader('Authorization', $headerVal);
    }


    /**
     * @var ODataRequest $pendingRequest
     */
    private $pendingRequest;


    /**
     * @var callable
     */
    private $acquireTokenFunc;

}
