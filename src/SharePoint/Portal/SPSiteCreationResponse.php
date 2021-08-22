<?php

namespace Office365\SharePoint\Portal;

use Office365\Runtime\ClientValue;

class SPSiteCreationResponse extends ClientValue
{
    function getServerTypeName()
    {
        return "Microsoft.SharePoint.Portal.SPSiteCreationResponse";
    }


    /**
     * @var string
     */
    public $SiteId;

    /**
     * @var string
     */
    public $SiteStatus;

    /**
     * @var string
     */
    public $SiteUrl;

}