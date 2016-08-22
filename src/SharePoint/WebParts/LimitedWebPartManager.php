<?php


namespace SharePoint\PHP\Client\WebParts;

require_once('PersonalizationScope.php');
require_once('WebPart.php');
require_once('WebPartDefinition.php');
require_once('WebPartDefinitionCollection.php');


use SharePoint\PHP\Client\ClientActionInvokePostMethod;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ResourcePathEntity;
use SharePoint\PHP\Client\Runtime\ODataPayload;
use SharePoint\PHP\Client\Runtime\ODataPayloadKind;


class LimitedWebPartManager extends ClientObject
{

    /**
     * Imports a Web Part from a string in the .dwp format
     * @param string $webPartXml
     * @return WebPartDefinition
     */
    public function importWebPart($webPartXml)
    {
        $payload = new ODataPayload(array("webPartXml" => $webPartXml),ODataPayloadKind::Entry,$this->getEntityTypeName());
        $webPartDefinition = new WebPartDefinition($this->getContext());
        $qry = new ClientActionInvokePostMethod(
            $this,
            "ImportWebPart",
            null,
            $payload
        );
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
                new WebPartDefinitionCollection($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "WebParts"))
            );
        }
        return $this->getProperty("WebParts");
    }

}