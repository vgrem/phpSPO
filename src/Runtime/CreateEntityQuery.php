<?php
namespace Office365\PHP\Client\Runtime;


class CreateEntityQuery extends InvokePostMethodQuery
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param ClientObject $entityCollection
     * @param ClientObject $entity
     */
    public function __construct(ClientObject $entityCollection, ClientObject $entity)
    {
        parent::__construct($entityCollection,null,null,$entity);
    }

}