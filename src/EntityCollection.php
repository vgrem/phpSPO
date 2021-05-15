<?php


namespace Office365;

use Office365\Runtime\Actions\CreateEntityQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

/**
 * @method GraphServiceClient getContext()
 */
class EntityCollection extends ClientObjectCollection
{
    /**
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath|null $resourcePath
     * @param null $itemTypeName
     */
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, $itemTypeName = null)
    {
        parent::__construct($ctx, $resourcePath, $itemTypeName);
    }

    /**
     * @param string $id Entity Id
     * @return ClientObject
     */
    function getById($id)
    {
        return $this->createType(new ResourcePath($id, $this->getResourcePath()));
    }

    /**
     * A generic way to create a new resource
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

    /**
     * Returns the value at specified offset
     *
     * @param int|string Entity could be addressed by id/userPrincipalName or by index offset
     * @access public
     * @return ClientObject
     * @abstracting ArrayAccess
     */
    public function offsetGet($offset)
    {
        if(is_int($offset))
            return parent::offsetGet($offset);
        return $this->getById($offset);
    }

}