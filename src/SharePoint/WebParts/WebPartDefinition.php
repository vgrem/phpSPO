<?php


namespace Office365\PHP\Client\SharePoint\WebParts;

use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientObject;


class WebPartDefinition extends ClientObject
{

    public function saveWebPartChanges(){
        $qry = new InvokePostMethodQuery(
            $this->getResourcePath(),
            "SaveWebPartChanges"
        );
        $this->getContext()->addQuery($qry);
    }

    public function closeWebPart()
    {
        $qry = new InvokePostMethodQuery(
            $this->getResourcePath(),
            "CloseWebPart"
        );
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