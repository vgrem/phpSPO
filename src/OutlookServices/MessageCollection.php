<?php


namespace Office365\OutlookServices;

use Office365\Runtime\Actions\CreateEntityQuery;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ResourcePath;

class MessageCollection extends ClientObjectCollection
{

    /**
     * Creates a Draft Message resource
     * @return Message
     */
    public function createMessage() {
        $message = new Message($this->getContext());
        $this->addChild($message);
        $qry = new CreateEntityQuery($message);
        $this->getContext()->addQueryAndResultObject($qry, $message);
        return $message;
    }

    /**
     * @param $messageId
     * @return Message
     */
    public function getMessage($messageId)
    {
        if (!$this->isPropertyAvailable("Messages")) {
            $this->setProperty("Messages",
                new Message($this->getContext(), new ResourcePath(
                    $messageId,
                    $this->getResourcePath()
                )));
        }
        return $this->getProperty("Messages");
    }

}