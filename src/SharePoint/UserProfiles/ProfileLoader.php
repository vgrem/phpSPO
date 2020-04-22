<?php

/**
 * Updated By PHP Office365 Generator 2019-11-16T20:09:17+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint\UserProfiles;

use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;

class ProfileLoader extends ClientObject
{
    public function __construct(ClientRuntimeContext $ctx)
    {
        parent::__construct($ctx, new ResourcePath("SP.UserProfiles.ProfileLoader"));
    }

}
