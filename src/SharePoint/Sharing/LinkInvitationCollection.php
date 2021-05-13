<?php

/**
 * Modified: 2019-10-26T18:29:48+00:00 16.0.19416.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValueCollection;

class LinkInvitationCollection extends ClientValueCollection
{
    public function __construct()
    {
        parent::__construct(LinkInvitation::class);
    }
}