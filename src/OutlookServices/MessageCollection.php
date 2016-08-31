<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionCreateEntity;
use Office365\PHP\Client\Runtime\ClientObjectCollection;

class MessageCollection extends ClientObjectCollection
{

    /**
     * Creates a Draft Message resource
     * @return Message
     */
    public function createMessage() {
        $message = new Message($this->getContext());
        $qry = new ClientActionCreateEntity($this, $message);
        $this->getContext()->addQuery($qry, $message);
        $this->addChild($message);
        return $message;
    }

}