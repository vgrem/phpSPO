<?php


namespace SharePoint\PHP\Client\WebParts;

use SharePoint\PHP\Client\ClientActionType;
use SharePoint\PHP\Client\ClientObject;
use SharePoint\PHP\Client\ClientQuery;

class WebPartDefinition extends ClientObject
{

    public function saveWebPartChanges(){
        $qry = new ClientQuery($this->getUrl() . "/SaveWebPartChanges",ClientActionType::PostRead);
        $this->getContext()->addQuery($qry);
    }

    public function closeWebPart()
    {
        $qry = new ClientQuery($this->getUrl() . "/CloseWebPart",ClientActionType::PostRead);
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