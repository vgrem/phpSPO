<?php

namespace Office365\Directory\Groups;

use Office365\EntityCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class GroupCollection extends EntityCollection
{

    public function __construct(ClientRuntimeContext $ctx, ?ResourcePath $resourcePath = null)
    {
        parent::__construct($ctx, $resourcePath, Group::class);
    }

    /**
     * Create a Microsoft 365 group
     * @param $displayName
     * @param string|null $mailNickName
     * @param string|null $description
     * @return Group
     */
    public function createM365($displayName, $mailNickName=null, $description=null){
        /** @var Group $returnType */
        $returnType = $this->add();
        $returnType->setDisplayName($displayName);
        $returnType->setMailNickname($mailNickName ?? $displayName);
        $returnType->setMailEnabled(true);
        $returnType->setGroupTypes(["Unified"]);
        $returnType->setSecurityEnabled(false);
        $returnType->setDescription($description ?? $displayName);
        return $returnType;
    }

}