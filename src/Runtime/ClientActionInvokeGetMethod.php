<?php

namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\OData\ODataPayload;

class ClientActionInvokeGetMethod extends ClientActionInvokeMethod
{
    /**
     * ClientActionInvokeGetMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $methodParameters
     * @param ODataPayload $payload
     */
    public function __construct(ClientObject $parentClientObject, $methodName = null, array $methodParameters = null, $payload=null)
    {
        parent::__construct($parentClientObject,$methodName,$methodParameters,$payload,ClientActionType::GetMethod);
    }


}