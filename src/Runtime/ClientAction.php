<?php

namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;


/**
 * OData query class
 */
class ClientAction
{

    /**
     * @var ResourcePath
     */
    protected $resourcePath;


    /**
     * @var $queryOptions ODataQueryOptions
     */
    protected $queryOptions;


    /**
     * ClientAction constructor.
     * @param ResourcePath $resourcePath
     */
    public function __construct(ResourcePath $resourcePath)
    {
        $this->resourcePath = $resourcePath;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }


    /**
     * @return ResourcePath
     */
    public function getResourcePath(){
        return $this->resourcePath;
    }


    /**
     * @return ODataQueryOptions
     */
    public function getQueryOptions(){
        return $this->queryOptions;
    }

}

