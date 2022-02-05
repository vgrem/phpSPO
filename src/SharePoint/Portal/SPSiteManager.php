<?php


namespace Office365\SharePoint\Portal;


use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ServerTypeInfo;
use Office365\SharePoint\BaseEntity;
use Office365\SharePoint\ClientContext;

class SPSiteManager extends BaseEntity
{

    public function __construct(ClientContext $ctx)
    {
        parent::__construct($ctx,new ResourcePath("SPSiteManager"));
    }

    /**
     * @param string $title
     * @param string $owner
     * @param string $classification
     * @param int $lcid
     * @return ClientResult
     */
    public function create($title, $owner=null, $classification=null, $lcid=1033){
        $request = new SPSiteCreationRequest();
        $request->Title = $title;
        $request->Description = $title;
        $request->Owner = $owner;
        $request->Url = "{$this->getContext()->getBaseUrl()}/sites/{$title}";
        $request->Lcid = $lcid;
        $request->ShareByEmailEnabled = false;
        $request->WebTemplate = "SITEPAGEPUBLISHING#0";
        $request->SiteDesignId = "6142d2a0-63a5-4ba0-aede-d9fefca2c767";
        $request->Classification = $classification;
        $qry = new InvokePostMethodQuery($this,"Create",null, "request", $request);

        $result = new ClientResult($this->context, new SPSiteCreationResponse());
        $this->getContext()->addQueryAndResultObject($qry, $result);
        return $result;
    }


    /**
     * @param string $siteId
     * @return $this
     */
    public function delete($siteId){
        $qry = new InvokePostMethodQuery($this,"Delete",array($siteId));
        $this->getContext()->addQuery($qry);
        return $this;
    }


    /**
     * @return ServerTypeInfo
     */
    public function getServerTypeInfo()
    {
        return new ServerTypeInfo("Microsoft.SharePoint.Portal", "SPSiteManager");
    }

}