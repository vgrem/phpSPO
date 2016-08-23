<?php

namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\OData\ODataPayload;

class ClientActionInvokePostMethod extends ClientActionInvokeMethod
{

    /**
     * ClientActionUpdateMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $methodParameters
     * @param ODataPayload $payload
     */
    public function __construct(ClientObject $parentClientObject, $methodName = null, array $methodParameters = null, ODataPayload $payload=null)
    {
        parent::__construct($parentClientObject,$methodName,$methodParameters,$payload,ClientActionType::PostMethod);
    }
    

}