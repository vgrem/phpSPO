<?php

namespace Office365\SharePoint\Portal;

use Office365\Runtime\ClientValue;
use Office365\Runtime\ServerTypeInfo;

class SPSiteCreationResponse extends ClientValue
{
    /**
     * @return ServerTypeInfo
     */
    function getServerTypeInfo()
    {
        return new ServerTypeInfo("Microsoft.SharePoint.Portal", "SPSiteCreationResponse");
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