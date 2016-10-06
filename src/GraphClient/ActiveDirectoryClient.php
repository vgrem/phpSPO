<?php

namespace Office365\PHP\Client\GraphClient;


use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\OData\JsonLightFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;


require_once('GraphObject.php');
require_once('DirectoryObject.php');
require_once('DirectoryObjectCollection.php');

class ActiveDirectoryClient extends ClientRuntimeContext
{
    public function __construct(IAuthenticationContext $authContext)
    {
        $authorityUrl = "https://graph.windows.net";
        parent::__construct($authorityUrl, $authContext,new JsonLightFormat(ODataMetadataLevel::Verbose));
    }


    public function executeQuery()
    {
        $this->getPendingRequest()->beforeExecuteQuery(function (RequestOptions $request,ClientAction $query){

        });
        parent::executeQuery();
    }

}