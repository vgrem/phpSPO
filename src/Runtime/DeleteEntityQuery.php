<?php


namespace Office365\Runtime;


class DeleteEntityQuery extends InvokePostMethodQuery
{

    /**
     * @param ClientObject $entityToDelete
     */
    public function __construct($entityToDelete)
    {
        parent::__construct($entityToDelete);
    }
}