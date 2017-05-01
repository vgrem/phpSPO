<?php


namespace Office365\PHP\Client\Runtime;

use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;

class ClientActionReadEntity extends ClientAction
{
    /**
     * ClientActionUpdateMethod constructor.
     * @param ResourcePath $resourcePath
     * @param ODataQueryOptions|null $queryOptions
     */
    public function __construct(ResourcePath $resourcePath,ODataQueryOptions $queryOptions = null)
    {
        parent::__construct($resourcePath,null,ClientActionType::GetMethod);
        $this->QueryOptions = $queryOptions;
    }
}