<?php
namespace Office365\PHP\Client\Runtime;


class CreateEntityQuery extends InvokePostMethodQuery
{

    /**
     * @param ClientObject $entityToCreate
     */
    public function __construct(ClientObject $entityToCreate)
    {
        parent::__construct($entityToCreate->getParentCollection(),null,null,null,$entityToCreate);
    }

}