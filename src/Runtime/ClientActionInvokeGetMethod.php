<?php

namespace SharePoint\PHP\Client;


use SharePoint\PHP\Client\Runtime\ODataEntity;

class ClientActionInvokeGetMethod extends ClientActionInvokeMethod
{
    /**
     * ClientActionInvokeGetMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $methodParameters
     * @param ODataEntity $payload
     */
    public function __construct(ClientObject $parentClientObject, $methodName = null, array $methodParameters = null, $payload=null)
    {
        parent::__construct($parentClientObject,$methodName,$methodParameters,$payload,ClientActionType::GetMethod);
    }


}