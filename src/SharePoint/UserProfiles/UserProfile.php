<?php


namespace SharePoint\PHP\Client\UserProfiles;

use SharePoint\PHP\Client\ClientActionInvokePostMethod;
use SharePoint\PHP\Client\ClientRuntimeContext;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ResourcePathEntity;

class UserProfile extends ClientObject
{

    public function __construct(ClientRuntimeContext $ctx)
    {
        parent::__construct($ctx, new ResourcePathEntity($ctx,null,"sp.UserProfiles.profileloader.getprofileloader/getuserprofile"));
    }

    /**
     * Enqueues creating a personal site for this user, which can be used to share documents, web pages, and other files.
     */
    public function createPersonalSiteEnque(){
        $qry = new ClientActionInvokePostMethod(
            $this,
            "createpersonalsiteenque",
            array(false)
        );
        $this->getContext()->addQuery($qry);
    }

}