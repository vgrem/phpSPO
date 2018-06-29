<?php


namespace Office365\PHP\Client\SharePoint\WebParts;

use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;


class LimitedWebPartManager extends ClientObject
{

    /**
     * Imports a Web Part from a string in the .dwp format
     * @param string $webPartXml
     * @return WebPartDefinition
     */
    public function importWebPart($webPartXml)
    {
        $payload = new ClientValueObject();
        $payload->setProperty("webPartXml",$webPartXml);
        $webPartDefinition = new WebPartDefinition($this->getContext());
        $qry = new InvokePostMethodQuery(
            $this->getResourcePath(),
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
