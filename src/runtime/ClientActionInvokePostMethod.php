<?php

namespace SharePoint\PHP\Client;


class ClientActionInvokePostMethod extends ClientActionInvokeMethod
{

    /**
     * ClientActionUpdateMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $actionParameters
     * @param string $payload
     */
    public function __construct(ClientObject $parentClientObject, $methodName = null, array $actionParameters = null, $payload=null)
    {
        parent::__construct($parentClientObject,$methodName,$actionParameters,$payload,ClientActionType::PostMethod);
    }
    

}