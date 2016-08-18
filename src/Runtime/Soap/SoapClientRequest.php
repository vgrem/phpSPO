<?php

//
class SoapClientRequest extends \SharePoint\PHP\Client\ClientRequest
{

    public function buildBatchRequest()
    {
        /*$root = new simpleXMLElement("<Request/>");
        $root->addAttribute("xmlns","http://schemas.microsoft.com/sharepoint/clientquery/2009");
        $root->addAttribute("ApplicationName","");
        $actions = $root->addChild("Actions");
        foreach( $this->queries as $query ) {
            $objectPath = $actions->addChild("ObjectPath");
        }
        $objectPaths = $root->addChild("ObjectPaths");
        $dom = dom_import_simplexml($root);
        return $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);*/
    }


    /**
     * @param \SharePoint\PHP\Client\ClientAction $query
     * @return \SharePoint\PHP\Client\RequestOptions
     */
    public function buildRequest(\SharePoint\PHP\Client\ClientAction $query)
    {
        // TODO: Implement buildRequest() method.
    }

    /**
     * @param string $response
     * @param \SharePoint\PHP\Client\ClientAction $query
     */
    public function processResponse($response, \SharePoint\PHP\Client\ClientAction $query)
    {
        // TODO: Implement processResponse() method.
    }
}