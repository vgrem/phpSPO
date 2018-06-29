<?php


namespace Office365\PHP\Client\Runtime;


class DeleteEntityQuery extends InvokePostMethodQuery
{

    /**
     * DeleteEntityQuery constructor.
     * @param ClientObject $clientObject
     */
    public function __construct(ClientObject $clientObject)
    {
        parent::__construct($clientObject->getResourcePath());
    }
}