<?php

namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\OData\ODataPayload;

class InvokeGetMethodQueryQuery extends InvokeMethodQuery
{
    /**
     * ClientActionInvokeGetMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $methodParameters
     * @param ODataPayload $methodPayload
     */
    public function __construct(ClientObject $parentClientObject, $methodName = null, array $methodParameters = null, $methodPayload=null)
    {
        parent::__construct($parentClientObject,$methodName,$methodParameters,$methodPayload);
    }


}