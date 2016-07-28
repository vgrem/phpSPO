<?php


namespace SharePoint\PHP\Client\UserProfiles;

use SharePoint\PHP\Client\ClientActionInvokePostMethod;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ResourcePathEntry;

class UserProfile extends ClientObject
{

    public function __construct(ClientContext $ctx)
    {
        parent::__construct($ctx, new ResourcePathEntry($ctx,null,"sp.userprofiles.profileloader.getprofileloader/getuserprofile"));
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