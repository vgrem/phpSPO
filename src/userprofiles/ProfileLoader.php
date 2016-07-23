<?php

namespace SharePoint\PHP\Client\UserProfiles;


use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ResourcePathEntry;

/**
 * Provides an alternate entry point to user profiles rather than calling methods directly.
 */
class ProfileLoader extends ClientObject
{

    public function __construct(ClientContext $ctx)
    {
        parent::__construct($ctx,new ResourcePathEntry($ctx,null,"sp.userprofiles.profileloader"));
    }




}