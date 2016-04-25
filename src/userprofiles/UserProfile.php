<?php


namespace SharePoint\PHP\Client\UserProfiles;

use SharePoint\PHP\Client\ClientActionType;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ClientQuery;

class UserProfile extends ClientObject
{

    public function __construct(ClientContext $ctx)
    {
        parent::__construct($ctx,null,"sp.userprofiles.profileloader.getprofileloader/getuserprofile");
    }

    /**
     * Enqueues creating a personal site for this user, which can be used to share documents, web pages, and other files.
     */
    public function createPersonalSiteEnque(){
        $qry = new ClientQuery($this->getUrl() . "/createpersonalsiteenque(false)", ClientActionType::Create);
        $this->getContext()->addQuery($qry);
    }

}