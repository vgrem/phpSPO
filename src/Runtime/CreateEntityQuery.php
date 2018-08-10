<?php
namespace Office365\PHP\Client\Runtime;


class CreateEntityQuery extends InvokePostMethodQuery
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param ClientObject $entity
     */
    public function __construct(ClientObject $entity)
    {
        $collection = $entity->getParentCollection();
        parent::__construct($collection->getResourcePath(),null,null,$entity);
    }

}