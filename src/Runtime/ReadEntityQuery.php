<?php


namespace Office365\PHP\Client\Runtime;

use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;

class ReadEntityQuery extends ClientAction
{

    /**
     * ReadEntityQuery constructor.
     * @param ClientObject $clientObject
     * @param ODataQueryOptions|null $queryOptions
     */
    public function __construct(ClientObject $clientObject,ODataQueryOptions $queryOptions = null)
    {
        $this->queryOptions = $queryOptions;
        parent::__construct($clientObject->getResourcePath());
    }
}