<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataEntity;

class ClientActionInvokePostMethod extends ClientActionInvokeMethod
{

    /**
     * ClientActionUpdateMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $methodParameters
     * @param ODataEntity $payload
     */
    public function __construct(ClientObject $parentClientObject, $methodName = null, array $methodParameters = null, ODataEntity $payload=null)
    {
        parent::__construct($parentClientObject,$methodName,$methodParameters,$payload,ClientActionType::PostMethod);
    }
    

}