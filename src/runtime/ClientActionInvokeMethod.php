<?php


namespace SharePoint\PHP\Client;


use SharePoint\PHP\Client\Runtime\ODataPathParser;

abstract class ClientActionInvokeMethod extends ClientAction
{
    /**
     * ClientActionInvokeMethod constructor.
     * @param ClientObject $parentClientObject
     * @param array $methodName
     * @param array $methodParameters
     * @param string $payload
     * @param int $actionType
     */
    public function __construct(ClientObject $parentClientObject, $methodName=null, array $methodParameters=null, $payload = null, $actionType = ClientActionType::ReadEntry)
    {
        $url = $parentClientObject->getResourceUrl() . "/" . ODataPathParser::fromMethod($methodName,$methodParameters);
        parent::__construct($url,$payload,$actionType);
    }
}