<?php


namespace Office365\PHP\Client\Runtime;



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