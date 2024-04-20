<?php

namespace Office365\Runtime\CSOM;


use Office365\Runtime\ClientRequest;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Response;

class CSOMRequest extends ClientRequest
{

    /**
     * @var string $AppName
     */
    //private static $AppName = "phpSPO Client";


    /**
     * @var string $SchemaVersion
     */
    //private static $SchemaVersion = "16.0.0.0";

    /**
     * Submit client request(s) to Office 365 API OData/SOAP service
     * @param $query
     */
    public function executeQuery($query)
    {
        // TODO: Implement executeQuery() method.
    }

    public function buildBatchRequest()
    {
        /*$request = new simpleXMLElement("<Request/>");
        $request->addAttribute("xmlns","http://schemas.microsoft.com/sharepoint/clientquery/2009");
        $request->addAttribute("ApplicationName",self::$AppName);
        $actions = $request->addChild("Actions");
        foreach( $this->queries as $query ) {
            $objectPath = $actions->addChild("ObjectPath");
        }
        $objectPaths = $request->addChild("ObjectPaths");
        $requestXml = dom_import_simplexml($request);
        return $requestXml->ownerDocument->saveXML($requestXml->ownerDocument->documentElement);*/
    }



    /**
     * @param RequestOptions $request
     */
    protected function setRequestHeaders(RequestOptions $request)
    {
        // TODO: Implement setRequestHeaders() method.
    }

    /**
     * @param Response $response
     * @param $query
     */
    public function processResponse($response, $query)
    {
        // TODO: Implement processResponse() method.
    }

    /**
     * Build Client Request
     * @param $query
     * @return void
     */
    public function buildRequest($query)
    {
        // TODO: Implement buildRequest() method.
    }

}
