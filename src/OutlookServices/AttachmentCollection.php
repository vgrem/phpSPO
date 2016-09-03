<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionCreateEntity;
use Office365\PHP\Client\Runtime\ClientObjectCollection;


class AttachmentCollection extends ClientObjectCollection
{

    /**
     * Creates Attachment resource
     * @param string $attachmentType
     * @return Attachment
     */
    public function createAttachment($attachmentType) {
        $attachment = new $attachmentType($this->getContext());
        $qry = new ClientActionCreateEntity($this, $attachment);
        $this->getContext()->addQuery($qry, $attachment);
        $this->addChild($attachment);
        return $attachment;
    }
}