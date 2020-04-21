<?php

namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\ResourcePathServiceOperation;

class AttachmentCollection extends ClientObjectCollection
{

    /**
     * Creates a Attachment resource
     * @param AttachmentCreationInformation $information
     * @return Attachment
     */
    public function add(AttachmentCreationInformation $information)
    {
        $attachment = new Attachment($this->getContext(),null);
        $qry = new InvokePostMethodQuery(
            $this,
            "add",
            array("FileName" =>rawurlencode($information->FileName)),
            null,
            $information->ContentStream);
        $this->getContext()->addQueryAndResultObject($qry,$attachment);
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
            new ResourcePathServiceOperation("GetByFileName",array($fileName),$this->getResourcePath())
        );
    }


}