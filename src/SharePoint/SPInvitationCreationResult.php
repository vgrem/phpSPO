<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:54:53+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;

class SPInvitationCreationResult extends ClientValueObject
{
    /**
     * @var string
     */
    public $Email;
    /**
     * @var string
     */
    public $InvitationLink;
    /**
     * @var bool
     */
    public $Succeeded;
}