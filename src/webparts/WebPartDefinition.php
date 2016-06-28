<?php


namespace SharePoint\PHP\Client\WebParts;

use SharePoint\PHP\Client\HttpMethod;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ClientAction;

class WebPartDefinition extends ClientObject
{

    public function saveWebPartChanges(){
        $qry = new ClientAction($this->getUrl() . "/SaveWebPartChanges",HttpMethod::Post);
        $this->getContext()->addQuery($qry);
    }

    public function closeWebPart()
    {
        $qry = new ClientAction($this->getUrl() . "/CloseWebPart",HttpMethod::Post);
        $this->getContext()->addQuery($qry);
    }


    /**
     * @return WebPart
     */
    public function getWebPart()
    {
        if (!$this->isPropertyAvailable('WebPart')) {
            $this->setProperty('WebPart', new WebPart($this->getContext(), $this->getResourcePath(), "WebPart"));
        }
        return $this->getProperty('WebPart');
    }
    
}