<?php


namespace Office365\PHP\Client\SharePoint\Portal;


use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePath;
use Office365\PHP\Client\SharePoint\ClientContext;


class GroupSiteManager extends ClientObject
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
        $payload = new ClientValueObject();
        $payload->setProperty("displayName",$displayName);
        $payload->setProperty("alias",$alias);
        $payload->setProperty("isPublic",$isPublic);
        if(!empty($description)){
            $payload->setProperty("description",$description);
        }
        //if(!is_null($additionalOwners)){
        //
        //}
        $info = new GroupSiteInfo();
        $qry = new InvokePostMethodQuery($this,"CreateGroupEx",null,null,$payload);
        $this->getContext()->addQueryAndResultObject($qry,$info);
        return $info;
    }

}
