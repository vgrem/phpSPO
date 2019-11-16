<?php

/**
 * Updated By PHP Office365 Generator 2019-11-16T20:09:17+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint\UserProfiles;

use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class ProfileLoader extends ClientObject
{
    public function __construct(ClientRuntimeContext $ctx)
    {
        parent::__construct($ctx, new ResourcePathEntity($ctx, null, "sp.UserProfiles.profileloader"));
    }

}
