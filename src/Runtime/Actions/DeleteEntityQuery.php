<?php


namespace Office365\Runtime\Actions;

use Office365\Runtime\ClientObject;

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