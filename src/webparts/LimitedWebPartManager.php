<?php


namespace SharePoint\PHP\Client\WebParts;

require_once('PersonalizationScope.php');
require_once('WebPart.php');
require_once('WebPartDefinition.php');
require_once('WebPartDefinitionCollection.php');


use SharePoint\PHP\Client\HttpMethod;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ClientAction;
use SharePoint\PHP\Client\ResourcePathEntry;
use SharePoint\PHP\Client\ResourcePathServiceOperation;

class LimitedWebPartManager extends ClientObject
{

    /**
     * Imports a Web Part from a string in the .dwp format
     * @param string $webPartXml
     * @return WebPartDefinition
     */
    public function importWebPart($webPartXml)
    {
        $payload = json_encode(array("webPartXml" => $webPartXml));
        $webPartDefinition = new WebPartDefinition(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"ImportWebPart")
        );
        $qry = new ClientAction($webPartDefinition->getResourceUrl(),$payload,HttpMethod::Post);
        $this->getContext()->addQuery($qry,$webPartDefinition);
        return $webPartDefinition;
    }


    /**
     * @return WebPartDefinitionCollection
     */
    public function getWebParts()
    {
        if(!$this->isPropertyAvailable('WebParts')){
            $this->setProperty(
                "WebParts", 
                new WebPartDefinitionCollection($this->getContext(),new ResourcePathEntry($this->getContext(),$this->getResourcePath(), "webparts"))
            );
        }
        return $this->getProperty("WebParts");
    }

}