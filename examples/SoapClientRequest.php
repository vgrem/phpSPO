<?php

namespace SharePoint\PHP\Client\Runtime\Soap;
use SimpleXMLElement;

class ClientRequest
{

    private $queries;

    public function buildQuery()
    {
        $root = new simpleXMLElement("<Request/>");
        $root->addAttribute("xmlns","http://schemas.microsoft.com/sharepoint/clientquery/2009");
        $root->addAttribute("ApplicationName","");
        $actions = $root->addChild("Actions");
        foreach( $this->queries as $query ) {
            $objectPath = $actions->addChild("ObjectPath");
        }
        $objectPaths = $root->addChild("ObjectPaths");
        $dom = dom_import_simplexml($root);
        return $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
    }

}