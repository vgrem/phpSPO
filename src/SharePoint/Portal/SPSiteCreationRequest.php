<?php

namespace Office365\SharePoint\Portal;

use Office365\Runtime\ClientValue;

class SPSiteCreationRequest extends ClientValue
{

    function getServerTypeName()
    {
        return "Microsoft.SharePoint.Portal.SPSiteCreationRequest";
    }

    /**
     * @var string
     */
    public $Classification;

    /**
     * @var string
     */
    public $Url;

    /**
     * @var string
     */
    public $WebTemplate;
    /**
     * @var int
     */
    public $Lcid;
    /**
     * @var false
     */
    public $ShareByEmailEnabled;
    /**
     * @var string
     */
    public $SiteDesignId;
    /**
     * @var string
     */
    public $Title;
    /**
     * @var string
     */
    public $Description;
    /**
     * @var string
     */
    public $Owner;

}