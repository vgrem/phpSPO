<?php


namespace Office365\Graph;

use Office365\Runtime\Actions\CreateEntityQuery;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class EntityCollection extends ClientObjectCollection
{
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, $itemTypeName = null)
    {
        parent::__construct($ctx, $resourcePath,null, $itemTypeName);
    }

    /**
     * @param string $id
     * @return Entity
     */
    function getById($id)
    {
        /** @var Entity $entity */
        $entity = $this->createType();
        $entity->resourcePath = new ResourcePath($id, $this->getResourcePath());
        return $entity;
    }

    /**
     * @return Entity
     */
    public function add(){
        /** @var Entity $entity */
        $entity = $this->createType();
        $this->addChild($entity);
        $qry = new CreateEntityQuery($entity);
        $this->getContext()->addQueryAndResultObject($qry,$entity);
        return $entity;
    }

}