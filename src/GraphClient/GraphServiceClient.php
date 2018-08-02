<?php

namespace Office365\PHP\Client\GraphClient;

use Office365\PHP\Client\OneDrive\CurrentUserRequestContext;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\OData\JsonSerializerContext;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\Office365Version;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

class GraphServiceClient extends ClientRuntimeContext
{
    public function __construct(IAuthenticationContext $authContext)
    {
        $serviceRootUrl = "https://graph.microsoft.com/" . Office365Version::V1 . "/";
        parent::__construct($serviceRootUrl, $authContext,new JsonSerializerContext(ODataMetadataLevel::Verbose));
    }


    public function executeQuery()
    {
        $this->getPendingRequest()->beforeExecuteQuery(function (RequestOptions $request,ClientAction $query){
        });
        parent::executeQuery();
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
