<?php


namespace Office365\SharePoint\Portal;


use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ResourcePath;
use Office365\SharePoint\BaseEntity;
use Office365\SharePoint\ClientContext;


class GroupSiteManager extends BaseEntity
{

    public function __construct(ClientContext $ctx)
    {
        parent::__construct($ctx,new ResourcePath("GroupSiteManager"));
    }

    /**
     * @param string $displayName
     * @param string $alias
     * @param boolean $isPublic
     * @param string $description
     * @return GroupSiteInfo
     */
    public function createGroupEx($displayName,$alias,$isPublic,$description="") {
        $payload = array();
        $payload["displayName"] = $displayName;
        $payload["alias"] =$alias;
        $payload["isPublic"] = $isPublic;
        if(!empty($description)){
            $payload["description"] = $description;
        }
        //if(!is_null($additionalOwners)){
        //
        //}
        $result = new GroupSiteInfo();
        $qry = new InvokePostMethodQuery($this,"CreateGroupEx",null,"CreateGroupEx",$payload);
        $this->getContext()->addQueryAndResultObject($qry,$result);
        return $result;
    }

}
