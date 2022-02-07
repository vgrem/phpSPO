<?php

namespace Office365\SharePoint;

use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Paths\ServiceOperationPath;
use Office365\Runtime\ResourcePath;

class AttachmentCollection extends BaseEntityCollection
{

    /**
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath|null $resourcePath
     * @param ClientObject|null $parent
     */
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, Attachment::class, $parent);
    }

    /**
     * Creates an Attachment resource
     * @param AttachmentCreationInformation|string $information_or_path
     * @return Attachment
     */
    public function add($information_or_path)
    {
        if(is_string($information_or_path)){
            $fileName = rawurlencode(basename($information_or_path));
            $fileContent = file_get_contents($information_or_path);
        }
        else{
            $fileName = rawurlencode($information_or_path->FileName);
            $fileContent = $information_or_path->ContentStream;
        }

        $attachment = new Attachment($this->getContext(),null);
        $qry = new InvokePostMethodQuery(
            $this,
            "add",
            array("FileName" =>$fileName),
            null,
            $fileContent);
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
            new ServiceOperationPath("GetByFileName",array($fileName),$this->getResourcePath())
        );
    }


}