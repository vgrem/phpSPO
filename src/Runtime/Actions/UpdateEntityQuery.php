<?php


namespace Office365\Runtime\Actions;



use Office365\Runtime\ClientObject;

class UpdateEntityQuery extends InvokePostMethodQuery
{
    /**
     * @param ClientObject $entityToUpdate
     */
    public function __construct(ClientObject $entityToUpdate)
    {
        parent::__construct($entityToUpdate,null,null,null,$entityToUpdate);
    }

}