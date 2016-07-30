<?php

namespace SharePoint\PHP\Client;


class ClientActionInvokeGetMethod extends ClientActionInvokeMethod
{
    /**
     * ClientActionInvokeGetMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $actionParameters
     * @param string $payload
     */
    public function __construct(ClientObject $parentClientObject, $methodName = null, array $actionParameters = null, $payload=null)
    {
        parent::__construct($parentClientObject,$methodName,$actionParameters,$payload,ClientActionType::GetMethod);
    }


}