<?php


namespace SharePoint\PHP\Client;


use SharePoint\PHP\Client\Runtime\ODataPathParser;
use SharePoint\PHP\Client\Runtime\ODataPayload;

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