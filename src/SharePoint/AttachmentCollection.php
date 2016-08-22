<?php

namespace SharePoint\PHP\Client;


class AttachmentCollection extends ClientObjectCollection
{

    /**
     * Creates a Attachment resource
     * @param AttachmentCreationInformation $information
     * @return Attachment
     */
    public function add(AttachmentCreationInformation $information)
    {
        $attachment = new Attachment($this->getContext());
        $qry = new ClientActionCreateEntity($this,$information->convertToPayload());
        $this->getContext()->addQuery($qry,$attachment);
        $this->addChild($attachment);
        return $attachment;
    }

    /**
     * @param string $fileName
     * @return Attachment
     */
    public function getByFileName($fileName)
    {
        return new Attachment(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"GetByFileName",array($fileName))
        );
    }


}