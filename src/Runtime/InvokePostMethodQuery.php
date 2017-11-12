<?php

namespace Office365\PHP\Client\Runtime;



class InvokePostMethodQuery extends InvokeMethodQuery
{


    /**
     * ClientActionUpdateMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $methodParameters
     * @param string|ISchemaType $methodPayload
     */
    public function __construct(ClientObject $parentClientObject, $methodName = null,$methodParameters=null,$methodPayload=null)
    {
        $this->MethodPayload = $methodPayload;
        parent::__construct($parentClientObject,$methodName, $methodParameters);
    }



    /**
     * @var string|ISchemaType $MethodPayload
     */
    public $MethodPayload;
    

}