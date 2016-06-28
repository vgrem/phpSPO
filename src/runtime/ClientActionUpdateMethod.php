<?php

namespace SharePoint\PHP\Client;


class ClientActionUpdateMethod extends ClientActionInvokeMethod
{

    /**
     * ClientActionUpdateMethod constructor.
     * @param string $resourceUrl
     * @param array $methodName
     * @param array $methodParameters
     */
    public function __construct($resourceUrl,$methodName = null,array $methodParameters = null)
    {
        parent::__construct($resourceUrl,$methodName,$methodParameters,HttpMethod::Post);
    }
    

}