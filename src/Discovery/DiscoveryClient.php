<?php

namespace Office365\PHP\Client\Discovery;

use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\ClientActionReadEntity;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\OData\JsonFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;

class DiscoveryClient extends ClientRuntimeContext
{

    public function __construct(IAuthenticationContext $authContext)
    {
        $serviceRootUrl = "https://api.office.com/discovery/v1.0/me/";
        parent::__construct($serviceRootUrl, $authContext,new JsonFormat(ODataMetadataLevel::Verbose));
    }



    public function getDiscoverCapabilities()
    {
        $capabilities = new CapabilityDiscoveryResult();
        $qry = new ClientActionReadEntity($this->getServiceRootUrl());
        $this->addQuery($qry,$capabilities);
        $this->executeQuery();
        return $capabilities;
    }

}