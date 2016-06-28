<?php


namespace SharePoint\PHP\Client;


use SharePoint\PHP\Client\Runtime\ODataPathParser;

class ClientActionInvokeMethod extends ClientAction
{
    /**
     * ClientActionUpdateMethod constructor.
     * @param string $resourceUrl
     * @param array $methodName
     * @param array $methodParameters
     * @param int $methodType
     */
    public function __construct($resourceUrl,$methodName=null,array $methodParameters=null,$methodType = HttpMethod::Get)
    {
        $url = $resourceUrl . "/" . ODataPathParser::fromMethod($methodName,$methodParameters);
        parent::__construct($url,null,$methodType);
    }
}