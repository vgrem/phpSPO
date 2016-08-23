<?php


namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\OData\ODataPathParser;
use Office365\PHP\Client\Runtime\OData\ODataPayload;

abstract class ClientActionInvokeMethod extends ClientAction
{


    /**
     * ClientActionInvokeMethod constructor.
     * @param ClientObject $parentClientObject
     * @param array $methodName
     * @param array $methodParameters
     * @param ODataPayload $payload
     * @param int $actionType
     */
    public function __construct(ClientObject $parentClientObject, $methodName=null, array $methodParameters=null, $payload = null, $actionType = ClientActionType::ReadEntity)
    {
        $url = $parentClientObject->getResourceUrl() . "/" . ODataPathParser::fromMethod($methodName,$methodParameters);
        parent::__construct($url,$payload,$actionType);
        $this->MethodName = $methodName;
        $this->MethodParameters = $methodParameters;
    }


    /**
     * @var string
     */
    public $MethodName;


    /**
     * @var array
     */
    public $MethodParameters;
}