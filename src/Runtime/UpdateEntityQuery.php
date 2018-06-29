<?php


namespace Office365\PHP\Client\Runtime;


class UpdateEntityQuery extends InvokePostMethodQuery
{

    /**
     * ClientActionUpdateEntity constructor.
     * @param ClientObject $entity
     */
    public function __construct(ClientObject $entity)
    {
        parent::__construct($entity->getResourcePath(),null,null,$entity);
    }



}