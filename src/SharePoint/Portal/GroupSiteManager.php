<?php


namespace Office365\PHP\Client\SharePoint\Portal;


use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\SharePoint\ClientContext;


class GroupSiteManager extends ClientObject
{

    public function __construct(ClientContext $ctx)
    {
        $ctx->getSerializerContext()->MetadataLevel = ODataMetadataLevel::NoMetadata;
        parent::__construct($ctx,new ResourcePathEntity($ctx,null,"GroupSiteManager"));

    }

    /**
     * @param string $displayName
     * @param string $alias
     * @param boolean $isPublic
     * @param string $description
     * @param null $additionalOwners
     * @return GroupSiteInfo
     */
    public function createGroupEx($displayName,$alias,$isPublic,$description="",$additionalOwners=null) {
        $payload = new ClientValueObject();
        $payload->setProperty("displayName",$displayName);
        $payload->setProperty("alias",$alias);
        $payload->setProperty("isPublic",$isPublic);
        if(!empty($description)){
            $payload->setProperty("description",$description);
        }
        if(!is_null($additionalOwners)){

        }
        $info = new GroupSiteInfo();
        $qry = new InvokePostMethodQuery($this->getResourcePath(),"CreateGroupEx",null,$payload);
        $this->getContext()->addQuery($qry,$info);
        return $info;
    }



}