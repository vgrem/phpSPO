<?php

namespace Office365\SharePoint;

use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathServiceOperation;

class AttachmentCollection extends BaseEntityCollection
{

    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, Attachment::class, $parent);
    }

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