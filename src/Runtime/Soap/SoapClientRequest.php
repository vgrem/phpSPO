<?php

namespace Office365\PHP\Client\Runtime;

use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use SimpleXMLElement;

class SoapClientRequest extends ClientRequest
{

    public function buildBatchRequest()
    {
        /*$root = new simpleXMLElement("<Request/>");
        $root->addAttribute("xmlns","http://schemas.microsoft.com/sharepoint/clientquery/2009");
        $root->addAttribute("ApplicationName",self::$AppName);
        $actions = $root->addChild("Actions");
        foreach( $this->queries as $query ) {
            $objectPath = $actions->addChild("ObjectPath");
        }
        $objectPaths = $root->addChild("ObjectPaths");
        $dom = dom_import_simplexml($root);
        return $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);*/
    }


    /**
     * @param ClientAction $query
     * @return RequestOptions
     */
    public function buildRequest(ClientAction $query)
    {
        // TODO: Implement buildRequest() method.
    }

    /**
     * @param string $response
     * @param ClientAction $query
     */
    public function processResponse($response, ClientAction $query)
    {
        // TODO: Implement processResponse() method.
    }


    /**
     * @var string $AppName
     */
    private static $AppName = "phpSPO Client";


    /**
     * @var string $SchemaVersion
     */
    private static $SchemaVersion = "16.0.0.0";
}