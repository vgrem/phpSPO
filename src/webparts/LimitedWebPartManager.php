<?php


namespace SharePoint\PHP\Client\WebParts;

require_once('PersonalizationScope.php');
require_once('WebPart.php');
require_once('WebPartDefinition.php');
require_once('WebPartDefinitionCollection.php');


use SharePoint\PHP\Client\ClientObject;

class LimitedWebPartManager extends ClientObject
{

    public function getWebParts()
    {
        if(!$this->isPropertyAvailable('WebParts')){
            $this->setProperty("WebParts", new WebPartDefinitionCollection($this->getContext(),$this->getResourcePath(), "webparts"));
        }
        return $this->getProperty("WebParts");
    }

}