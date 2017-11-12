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
    public $ResourcePath;


    /**
     * @var $QueryOptions ODataQueryOptions
     */
    public $QueryOptions;


    /**
     * ClientAction constructor.
     * @param ResourcePath $resourcePath
     */
    public function __construct(ResourcePath $resourcePath)
    {
        $this->ResourcePath = $resourcePath;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }

}

