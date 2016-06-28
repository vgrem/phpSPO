<?php


namespace SharePoint\PHP\Client\UserProfiles;

use SharePoint\PHP\Client\ClientActionInvokeMethod;
use SharePoint\PHP\Client\HttpMethod;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ResourcePathEntity;

class UserProfile extends ClientObject
{

    public function __construct(ClientContext $ctx)
    {
        parent::__construct($ctx, new ResourcePathEntity($ctx,null,"sp.userprofiles.profileloader.getprofileloader/getuserprofile"));
    }

    /**
     * Enqueues creating a personal site for this user, which can be used to share documents, web pages, and other files.
     */
    public function createPersonalSiteEnque(){
        $qry = new ClientActionInvokeMethod($this->getResourceUrl(), "createpersonalsiteenque",array(false), HttpMethod::Post);
        $this->getContext()->addQuery($qry);
    }

}