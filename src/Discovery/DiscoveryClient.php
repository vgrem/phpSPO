<?php

namespace Office365\PHP\Client\Discovery;

use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\OData\JsonSerializerContext;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\Office365Version;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class DiscoveryClient extends ClientRuntimeContext
{

    public function __construct(IAuthenticationContext $authContext, $version = Office365Version::V1)
    {
        $serviceRootUrl = "https://api.office.com/discovery/$version/";
        parent::__construct($serviceRootUrl, $authContext,new JsonSerializerContext(ODataMetadataLevel::NoMetadata),$version);
    }



    /**
     * @return ServiceInfoCollection
     */
    public function getAllServices()
    {
        $allServices = new ServiceInfoCollection();
        $path = new ResourcePathEntity($this,null, "me/allServices");
        $qry = new ClientAction($path);
        $this->addQuery($qry,$allServices);
        return $allServices;
    }
}