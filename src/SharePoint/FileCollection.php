<?php

namespace Office365\SharePoint;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathServiceOperation;


/**
 * File collections
 *
 */
class FileCollection extends BaseEntityCollection
{

    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, File::class, $parent);
    }

    /**
     * Creates a File resource
     * @param FileCreationInformation $fileCreationInformation
     * @return File
     */
    public function add(FileCreationInformation $fileCreationInformation)
    {
        $file = new File($this->getContext(),$this->getResourcePath());
        $qry = new InvokePostMethodQuery(
            $this,
            "add",
            array("overwrite"=>$fileCreationInformation->Overwrite,"url"=>rawurlencode($fileCreationInformation->Url)),
            null,
            $fileCreationInformation->Content
            );
        $this->getContext()->addQueryAndResultObject($qry,$file);
        $this->addChild($file);
        return $file;
    }


    /**
     * Adds a ghosted file to an existing list or document library.
     * @param $urlOfFile
     * @param $templateFileType
     * @return File
     */
    public function addTemplateFile($urlOfFile,$templateFileType)
    {
        $file = new File($this->getContext(),$this->getResourcePath());
        $qry = new InvokePostMethodQuery(
            $this,
            "addTemplateFile",
            array(
                "urlOfFile" => $urlOfFile,
                "templateFileType" => (int)$templateFileType
            )
        );
        $this->getContext()->addQueryAndResultObject($qry,$file);
        return $file;
    }


    /**
     * @param string $serverRelativeUrl
     * @return File
     */
    public function getByUrl($serverRelativeUrl){
        $path = new ResourcePathServiceOperation("getByUrl",array(
            rawurlencode($serverRelativeUrl)
        ),$this->getResourcePath());
        return new File($this->getContext(),$path);
    }


    /**
     * @param string $sourcePath
     * @param string $targetFileName
     * @param callable|null $chunkUploaded
     * @return UploadSession
     */
    public function createUploadSession($sourcePath, $targetFileName,callable $chunkUploaded=null){

        $session = new UploadSession();
        $session->buildQuery($this,$sourcePath,$targetFileName,$chunkUploaded);
        return $session;
    }

}